<?php
	include $_SERVER['DOCUMENT_ROOT']."/db.php";

	$ID = $_GET['bbsID'];
	$result = mq("SELECT * FROM bbs WHERE bbsID='$ID';");
	$board = mysqli_fetch_array($result);

	$list = '';

	// while($board){ //null일때까지 반복
	// 	if($row['bbsAvailable']==0){
	// 		break;
	// 	}else{
	// 		$list = $list."
	// 						<tr>
	// 							<td>{$row['bbsID']}</td>
	// 							<td><a href=\"view.php?bbsID={$row['bbsID']}\">{$row['bbsTitle']}</a></td>
	// 							<td>{$row['bbsName']}</td>
	// 							<td>{$row['bbsDate']}</td>
	// 						</tr>
	// 		";
	// 	}
	// }

	$board = array(
		'bbsID' => $board['bbsID'],
		'bbsTitle' =>$board['bbsTitle'],
		'bbsDate' => $board['bbsDate'],
		'bbsContent' => $board['bbsContent'],
		'bbsName' => $board['bbsName'],
		'bbsTel' => $board['bbsTel'],
		'bbsEmail' => $board['bbsEmail'],
		'bbsLock' => $board['bbsLock'],
		'bbsFile' => $board['bbsFile']
	);
	echo $result; // 확인용
?>
<?=$list?>


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
		<link rel="shortcut icon" href="/images/qui_logo_black.png" type="image/x-icon">
	</head>
	<body class="left-sidebar is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">

						<!-- Logo -->
                        <h1 id="logo"><a href="index.html">
                            <img src="/images/qui_logo_white.png" alt="QuiART" height="40" width="40">
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

							<a href="connect.html" class="button pull-left">Back</a><br>
							<div class="col-10 col-12-narrower imp-narrower">

								<!-- Content -->
                                <div id="content" class="container">
                                    <header class="major">
                                        <h2>회사 질의사항 및 요청</h2>
                                        <p>아래에 이름과 이메일 그리고 간단한 요청사항을 남겨주시면 곧 저희가 연락을 드리겠습니다.<br />
                                            저희의 지원팀은 어떠한 경우라도 최선을 다하여 고객의 고민을 해결해 드리도록 노력하겠습니다.</p>
                                    </header>
                                    <div class="row" >
                                        <section class="col-12">
                                            <form method="post" action="wirteAction.php">
												<input type="hidden" name="id" value="<?=$_GET['bbsID']?>">
												<div class="row" style="padding-bottom: 15px;">
													<div class="col-8 col-12-mobile">
														<label>제목</label>
														<?=$board(['bbsTitle'])?>
													</div>
													<div class="col-4 col-12-mobile">
														<!-- <input type ="password" name="bbsPassword" class="" placeholder="게시글 비밀번호"> -->
													</div>
												</div>
												<div class="row" style="padding-bottom: 20px;">
													<div class="col-4">
														<label>담당자 성함</label>
														<?=$board(['bbsName'])?>	
													</div>
													<div class="col-4">
														<label>담당자 연락처</label>
														<?=$board(['bbsTel'])?>
													</div>
													<div class="col-4">
														<label>담당자 이메일</label>
														<?=$board(['bbsEmail'])?>
													</div>
												</div>
												<div class="row" style="padding-bottom: 20px;">
													<div class="col-12">
														<label>내용</label>
														<?=$board(['bbsContent'])?>
													</div>
												</div>
												<div class="row">
													파일 : <a href="/upload/<?php echo $board['file'];?> download><?php echo $file;?></a>
												</div>	
												<br>
												<div class="row">
													<div class="col-8"></div>
													<div class="col-4 col-4-mobile" style="text-align: right;">
														<a href="update.php?bbsID=<?=$board['title']?>" class="button aln-right" value="수정">
														<a href="delete.php" class="button aln-right" value="삭제">
														<input type="submit" class="button aln-right" value="수정">
														<input type="submit" class="button aln-right" value="삭제">
													</div>
												</div>
												
                                            </form>
                                        </section>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>

			<!-- Footer -->
				<div id="footer-wrapper">
					<!-- <div id="footer" class="container">
						<header class="major">
							<h2><b>회사 질의사항 및 요청</b></h2>
							<p>각종 문의사항을 남겨주시면 최선을 다해 답변드리겠습니다.</p>
							<ul class="actions major">
								<li><a href="connect.html" class="button"><b>문의하기</b></a></li>
							</ul>
						</header>
						
					</div> -->
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