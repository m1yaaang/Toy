<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ page import="bbs.BbsDAO" %>
<%@ page import="java.io.PrintWriter" %>
<% request.setCharacterEncoding("utf-8"); %>

<jsp:useBean id="bbs" class="bbs.Bbs" scope="page"/>
<jsp:setProperty name="bbs" property="bbsTitle" />
<jsp:setProperty name="bbs" property="bbsContent" />
<jsp:setProperty name="bbs" property="bbsName" />
<jsp:setProperty name="bbs" property="bbsTel" />
<jsp:setProperty name="bbs" property="bbsEmail" />
<jsp:setProperty name="bbs" property="bbsPassword" />

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width", initial-scale="1">
<link rel="stylesheet" href="css/bootstrap.css">
<title>JSP 게시판 웹 사이트</title>
</head>
<body>
	<%
		if(bbs.getBbsTitle() == null || bbs.getBbsContent()==null || bbs.getBbsName()==null || bbs.getBbsTel() == null || bbs.getBbsEmail()==null || bbs.getBbsPassword()==null){
			PrintWriter script = response.getWriter();
			script.println("<script>");
			script.println("alert('입력이 안 된 사항이 있습니다.')");
			script.println("history.back()");
			script.println("</script>");	
		}
		else{
			BbsDAO bbsDAO = new BbsDAO();
			int result = bbsDAO.write(bbs.getBbsTitle(), bbs.getBbsContent(), bbs.getBbsName(), bbs.getBbsTel(), bbs.getBbsEmail(), bbs.getBbsPassword());
			if(result == -1){
				PrintWriter script = response.getWriter();
				script.println("<script>");
				script.println("alert('글쓰기에 실패했습니다.')");
				script.println("history.back()");
				script.println("</script>");	
			}else{
				PrintWriter script = response.getWriter();
				script.println("<script>");
				script.println("alert('작성이 완료되었습니다.')");
				script.println("location.href='bbs.jsp'");
				script.println("</script>");	
			}
		}		
	%>

</body>
</html>