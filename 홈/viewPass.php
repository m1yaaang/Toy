<?php include  $_SERVER['DOCUMENT_ROOT']."/db.php"; ?>
<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.dropotron.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script>
		$(funcntion(){
			$('#writepass').dialog({
				modal:true,
				title:'비밀글입니다.',
				width:400;
			});
		});
	</script>
<?php 
	$ID = $_GET['bbsID'];
	$result = mq("SELECT * FROM bbs WHERE bbsID='$ID';");
	$board = mysqli_fetch_array($result);
?>
<div id='writepass'>
	<form action="" method="post">
		<p>비밀번호
			<input type="password" name="bbsPassword">
			<input type="submit" value="확인">
		</p>
	</form>
</div>

<?php
	$bpw = $board(['bbsPassword']);

	if(isset($_POST['bbsPassword']))
	{
		$pwk = $_POST['bbsPassword'];
		if(password_verify($pwk,$bpw)){
			$pwk == $bpw;	
?>
	<script>location.replace("view.php?bbsID=<?php echo $board['bbsID'];?>";</script>
<?php 
		}else{ ?>
			<script>alert('비밀번호가 틀립니다');</script>
		<?php } } ?>