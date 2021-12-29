package bbs;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;

public class BbsDAO {
	private Connection conn;
	private PreparedStatement pstmt;
	private ResultSet rs;
	
	public BbsDAO() { //MYSQL 접속 부분
		try {
			String dbURL = "jdbc:mysql://localhost:3306/BBS?useUnicode=true&characterEncoding=UTF-8";
			String dbID = "root";
			String dbPassword = "quiart";
			Class.forName("com.mysql.jdbc.Driver");
			conn = DriverManager.getConnection(dbURL,dbID,dbPassword);
		} catch(Exception e) {
			e.printStackTrace();
		}
	}
	
	public String getDate() {
		String SQL = "SELECT NOW()";
		try {
			PreparedStatement pstmt = conn.prepareStatement(SQL);
			rs = pstmt.executeQuery();
			if(rs.next()) {
				return rs.getString(1);
			}
		}catch(Exception e) {
			e.printStackTrace();
		}
		return ""; // 데이터베이스 오류	
	}
	
	public int getNext() {
		String SQL = "SELECT bbsID FROM BBS ORDER BY bbsID DESC";
		try {
			PreparedStatement pstmt = conn.prepareStatement(SQL);
			rs = pstmt.executeQuery();
			if(rs.next()) {
				return rs.getInt(1)+1;
			}
			return 1; //첫 번째 게시물인 경우
		}catch(Exception e) {
			e.printStackTrace();
		}
		return -1; // 데이터베이스 오류	
	}

	public int write(String bbsTitle, String bbsContent, String bbsName, String bbsTel, String bbsEmail, String bbsPassword) {
		String SQL = "INSERT INTO BBS VALUES (?,?,?,?,?,?,?,?,?)";
		try {
			PreparedStatement pstmt = conn.prepareStatement(SQL);
			pstmt.setInt(1, getNext()); //bbsID
			pstmt.setString(2, bbsTitle); //bbsTitle
			pstmt.setString(3, getDate()); //bbsDate
			pstmt.setString(4, bbsContent); //bbsContent
			pstmt.setInt(5, 1); //bbsAvailable
			pstmt.setString(6, bbsName); //bbsName
			pstmt.setString(7, bbsTel); //bbsTel
			pstmt.setString(8, bbsEmail); //bbsEmail
			pstmt.setString(9, bbsPassword); //bbsPassword
			return pstmt.executeUpdate();
		}catch(Exception e) {
			e.printStackTrace();
		}
		return -1; // 데이터베이스 오류	
	}
	
	public ArrayList<Bbs> getList(int pageNumber){
		String SQL = "SELECT * FROM BBS WHERE bbsID < ? AND bbsAvailable = 1 ORDER BY bbsID DESC LIMIT 10";
		ArrayList<Bbs> list = new ArrayList<Bbs>();
		try {
			PreparedStatement pstmt = conn.prepareStatement(SQL);
			pstmt.setInt(1, getNext()-(pageNumber -1)*10);
			rs = pstmt.executeQuery();
			while (rs.next()) {
				Bbs bbs = new Bbs();
				bbs.setBbsID(rs.getInt(1));
				bbs.setBbsTitle(rs.getString(2));
				bbs.setBbsDate(rs.getString(3));
				bbs.setBbsContent(rs.getString(4));
				bbs.setBbsAvailable(rs.getInt(5));
				bbs.setBbsName(rs.getString(6));
				bbs.setBbsTel(rs.getString(7));
				bbs.setBbsEmail(rs.getString(8));
				bbs.setBbsPassword(rs.getString(9));
				list.add(bbs);
			}
		}catch(Exception e) {
			e.printStackTrace();
		}
		return list; // 데이터베이스 오류	
	}
	
	public boolean nextPage(int pageNumber) { //페이지 버튼 처리하는 함수
		String SQL = "SELECT * FROM BBS WHERE bbsID < ? AND bbsAvailable = 1 ORDER BY bbsID DESC LIMIT 10";
		try {
			PreparedStatement pstmt = conn.prepareStatement(SQL);
			pstmt.setInt(1, getNext()-(pageNumber -1)*10);
			rs = pstmt.executeQuery();
			if (rs.next()) {
				return true;
			}
		}catch(Exception e) {
			e.printStackTrace();
		}
		return false; // 데이터베이스 오류	
	}
	
	public Bbs getBbs(int bbsID) {
		String SQL = "SELECT * FROM BBS WHERE bbsID = ?";
		try {
			PreparedStatement pstmt = conn.prepareStatement(SQL);
			pstmt.setInt(1, bbsID);
			rs = pstmt.executeQuery();
			if (rs.next()) {
				Bbs bbs = new Bbs();
				bbs.setBbsID(rs.getInt(1));
				bbs.setBbsTitle(rs.getString(2));
				bbs.setBbsDate(rs.getString(3));
				bbs.setBbsContent(rs.getString(4));
				bbs.setBbsAvailable(rs.getInt(5));
				bbs.setBbsName(rs.getString(6));
				bbs.setBbsTel(rs.getString(7));
				bbs.setBbsEmail(rs.getString(8));
				bbs.setBbsPassword(rs.getString(9));
				return bbs;
			}
		}catch(Exception e) {
			e.printStackTrace();
		}
		return null; // 데이터베이스 오류	
	}
	
	public int update(int bbsID, String bbsTitle, String bbsContent, String bbsName, String bbsTel, String bbsEmail, String bbsPassword) {
		String SQL = "UPDATE BBS SET bbsTitle = ?, bbsContent =?, bbsName =?, bbsTel =?, bbsEmail =?, bbsPassword =?  WHERE bbsID = ?";
		try {
			PreparedStatement pstmt = conn.prepareStatement(SQL);
			pstmt.setString(1, bbsTitle);
			pstmt.setString(2, bbsContent);
			pstmt.setString(3, bbsName); 
			pstmt.setString(4, bbsTel); 
			pstmt.setString(5, bbsEmail); 
			pstmt.setString(6, bbsPassword); 
			pstmt.setInt(7, bbsID);
			return pstmt.executeUpdate(); //0 이상의 값 반환
		}catch(Exception e) {
			e.printStackTrace();
		}
		return -1; // 데이터베이스 오류	
	}
	
	
	public int delete(int bbsID) {
		String SQL = "UPDATE BBS SET bbsAvailable = 0 WHERE bbsID = ?";
		try {
			PreparedStatement pstmt = conn.prepareStatement(SQL);
			pstmt.setInt(1, bbsID);
			return pstmt.executeUpdate(); //0 이상의 값 반환
		}catch(Exception e) {
			e.printStackTrace();
		}
		return -1; // 데이터베이스 오류	
	}
	
	public int login(int bbsID, String bbsPassword) {
		String SQL = "SELECT bbsPassword FROM bbs WHERE bbsID = ?";
		try {
			pstmt = conn.prepareStatement(SQL); //인스턴스 값 생성
			pstmt.setInt(1,bbsID); // 해킹 기법 반환
			rs = pstmt.executeQuery();
			if(rs.next()) {
				if(rs.getString(1).equals(bbsPassword)) {
					return 1; //로그인 성공
				}
				else 
					return 0;//비밀번호 불일치
			}return -1; //글 존재 안 함
		} catch(Exception e) {
			e.printStackTrace();
		}return -2; //데이터베이스 오류
	}
}
