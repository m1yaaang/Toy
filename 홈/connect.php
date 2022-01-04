<?php include  $_SERVER['DOCUMENT_ROOT']."/db.php"; ?>
<?php
	$pageNumber = 1;
	if($_GET['pageNumber']!=null){
		$pageNumber = $_GET['pageNumber'];
	}
?>
<!DOCTYPE HTML>
<!--
	Telephasic by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>QuiART Sound Archtect</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="카이아트" content="소리 그리고 인공지능 카이아트">
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="shortcut icon" href="/images//images/qui_logo_black.png" type="image/x-icon">
	</head>
	<body class="left-sidebar is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">

						<!-- Logo -->
                        <h1 id="logo"><a href="index.html">
                            <img src="/images//images/qui_logo_white.png" alt="QuiART" height="40" width="40">
                            <br>QuiART</a></h1>

						<!-- Nav -->
						<nav id="nav">
							<ul>
								<li>
									<a href="#">회사소개</a>
									<ul>
										<li><a href="#">회사소개</a></li>
										<li><a href="#">신기술 및 관련 특허 내용</a></li>
										<li><a href="#">제품 소개</a></li>
									</ul>
								</li>
								<li>
									<a href="left-sidebar.html">제품소개</a>
									
									<ul>
										<li><a href="#">제품소개</a></li>
										<li><a href="#">기능</a></li>
										<li><a href="#">노이즈컨설팅</a></li>
										<li><a href="#">오디오 프로덕트</a></li>
									</ul>
								</li>
								<li class="break"><a href="connect.html">공지사항</a></li>
								<li><a href="connect.html">문의하기</a></li>
							</ul>
						</nav>
					</div>
				</div>

			<!-- Main -->
				<div class="wrapper">
					<div class="container" id="main">

						<!-- Content -->
							<article id="content">
								<header>
									<h2>문의하기</h2>
									<p>문의사항을 남겨주시면 최대한 빨리 연락드리겠습니다.</p>
								</header>
							</article>

						<div class="row features">
							<table class="table" style="text-align: center; border: 1px solid;">
								<thead>
									<tr>
										<th>번호</th>
										<th>제목</th>
										<th>작성자</th>
										<th>작성일<th>
									</tr>
								</thead>
								<tbody>
									<?php 
                                        $sql = "SELECT * FROM bbs WHERE bbsAvailable = 1 ORDER BY bbsID LIMIT 0,10 ";
                                        $result = mq($sql);
                                        $list = '';

										$row = mysqli_fetch_array($result)
										if(count($row)){}
                                        while($row){

											$title = {$row['bbsTitle']};
											if(strlen($title)>30){
												$title = str_replace({$row['bbsTitle']},mb_substr({$row['bbsTitle']},0,30,"utf-8")."...",{$row['bbsTitle']});
											}
											
											if($row['bbsLock']=="1"){ //잠긴 경우
												$lockimg="<img src='/imgages/lock.png' alt='lock' title='lock' with='20' height='20' />";
												$list = $list."
													<tr>
														<td>{$row['bbsID']}</td>
														<td><a href=\"viewPass.php?bbsID={$row['bbsID']}\">{$title} $lockimg</a></td>
														<td>{$row['bbsName']}</td>
														<td>{$row['bbsDate']}</td>
													</tr>
												";
											}else{
												$list = $list."
													<tr>
														<td>{$row['bbsID']}</td>
														<td><a href=\"view.php?bbsID={$row['bbsID']}\">{$title}</a></td>
														<td>{$row['bbsName']}</td>
														<td>{$row['bbsDate']}</td>
													</tr>
												";
											}
                                            
                                        }
                                    ?>
                                    <?=$list?>
								</tbody>
							</table>
							<?php
								if($pageNumber != 1){
							?>
							<a href='bbs.jsp?pageNumber=<?=$pageNumber-1?>' class='button pull-left'>이전</a>
							<?php	
								}if()
							?>	
							<a href='bbs.jsp?pageNumber=<?=$pageNumber+1?>' class='button pull-left'>다음</a>

							<a href="connect_write.html" class="button button-primary pull-right">작성하기</a>
						</div>

					</div>
				</div>

			<!-- Footer -->
			<div id="footer-wrapper">
				<div id="footer" class="container">
					<header class="major">
						<h2><b>회사 질의사항 및 요청</b></h2>
						<p>각종 문의사항을 남겨주시면 최선을 다해 답변드리겠습니다.</p>
						<ul class="actions major">
							<li><a href="connect.html" class="button"><b>문의하기</b></a></li>
						</ul>
					</header>
					
				</div>
				<div id="copyright" class="container">
					<ul class="menu">
						<li>(우)18330 경기도 화성시 봉담읍 최루백로 72 협성대학교 산학협력단 207호 카이아트</li>
						
						<br><li>Tel: 010-9009-0081</li>
						<li>Email: <a href="scham@quiart.kr">scham@quiart.kr</a></li>
						<br>
						<li>&copy;All rights reserved.</li>
					</ul>
				</div>
			</div>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script>
				$('#file_button').click(function(e){
					$('#file_upload').click();
				});
			</script>
	</body>
</html>