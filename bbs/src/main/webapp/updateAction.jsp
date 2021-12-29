<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ page import="bbs.BbsDAO" %>
<%@ page import="bbs.Bbs" %>
<%@ page import="java.io.PrintWriter" %>
<% request.setCharacterEncoding("utf-8"); %>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>JSP 게시판 웹 사이트</title>
</head>
<body>
	<%
	int bbsID =0;
	if(request.getParameter("bbsID") != null ){
		bbsID = Integer.parseInt(request.getParameter("bbsID"));
	}
	if(bbsID ==0){
		PrintWriter script = response.getWriter();
		script.println("<script>");
		script.println("alert('유효하지 않은 글입니다.')");
		script.println("location.href = 'bbs.jsp'");
		script.println("</script>");
	}
	else{
		if(request.getParameter("bbsTitle") == null || request.getParameter("bbsContent")==null || request.getParameter("bbsName")==null || request.getParameter("bbsTel") == null || request.getParameter("bbsEmail")==null || request.getParameter("bbsPassword")==null || request.getParameter("bbsTitle").equals("") || request.getParameter("bbsContent").equals("") || request.getParameter("bbsName").equals("") || request.getParameter("bbsTel").equals("") || request.getParameter("bbsEmail").equals("") || request.getParameter("bbsPassword").equals("")){
			PrintWriter script = response.getWriter();
			script.println("<script>");
			script.println("alert('입력이 안 된 사항이 있습니다.')");
			script.println("history.back()");
			script.println("</script>");	
		}
		else{
			BbsDAO bbsDAO = new BbsDAO();
			int result = bbsDAO.update(bbsID,request.getParameter("bbsTitle"),request.getParameter("bbsContent"),request.getParameter("bbsName"),request.getParameter("bbsTel"),request.getParameter("bbsEmail"),request.getParameter("bbsPassword"));
			if(result == -1){
				PrintWriter script = response.getWriter();
				script.println("<script>");
				script.println("alert('글 수정이 실패했습니다.')");
				script.println("history.back()");
				script.println("</script>");	
			}else{
				PrintWriter script = response.getWriter();
				script.println("<script>");
				script.println("location.href='bbs.jsp'");
				script.println("</script>");	
			}
		}
	}
	%>
</body>
</html>