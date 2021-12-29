<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ page import="bbs.BbsDAO" %>
<%@ page import="bbs.Bbs" %>
<%@ page import="java.io.PrintWriter" %>
<% request.setCharacterEncoding("UTF-8"); %>
<jsp:useBean id="bbs" class="bbs.Bbs" scope="page"/>
<jsp:setProperty name="bbs" property="bbsID"/>
<jsp:setProperty name="bbs" property="bbsPassword"/>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>JSP 게시판 웹 사이트</title>
</head>
<body>
	<%
			int bbsID = 0;
			if(request.getParameter("bbsID")!=null){
				bbsID = Integer.parseInt(request.getParameter("bbsID"));
			}
			BbsDAO bbsDAO = new BbsDAO();
			int result = bbsDAO.login(bbsID,request.getParameter("bbsPassword"));
			if(result == 1){
				PrintWriter script = response.getWriter();
				script.println("<script>");
				script.print("location.href = 'view.jsp?bbsID='");
				script.println(bbsID);
				script.println("</script>");
			}
			else if(result == 0) {
				PrintWriter script = response.getWriter();
				script.println("<script>");
				script.println("alert('비밀번호가 다릅니다.')");
				script.println("history.back()");
				script.println("</script>");	
			}
			else if(result == -1){
				PrintWriter script = response.getWriter();
				script.println("<script>");
				script.println("alert('존재하지 않는 글입니다.')");
				script.println("location.href='bbs.jsp'");
				script.println("</script>");	
			}
			else if(result == -2){
				PrintWriter script = response.getWriter();
				script.println("<script>");
				script.println("alert('데이터베이스 오류가 발생했습니다.')");
				script.println("history.back()");
				script.println("</script>");
			}
	%>
</body>
</html>