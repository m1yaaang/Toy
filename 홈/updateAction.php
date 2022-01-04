<!-- 문의사항 데이터베이스 전송 -->

<?php 
//$conn = mysqli_connect("39.127.118.32","ymy","quiart","bbs");

$title = mysqli_real_escape_string($conn, $_POST['bbsTitle']);
$content = mysqli_real_escape_string($conn, $_POST['bbsContent']);
$name = mysqli_real_escape_string($conn, $_POST['bbsName']);
$tel = mysqli_real_escape_string($conn, $_POST['bbsTel']);
$email = mysqli_real_escape_string($conn, $_POST['bbsEmail']);
$password = mysqli_real_escape_string($conn, $_POST['bbsPassword']);



$sql = "UPDATE bbs SET bbsTitle=$title, bbsContent = $content, bbsName = $name, bbsTel = $tel, bbsEmail = $email, bbsPassword = $password WHERE bbsID=$bbsID";

$result = mysqli_query($conn, $sql); //데이터베이스 전송
if($result == false){

}else{
    echo <a></a>
    alert('정상적으로 등록되었습니다.')
    location.href = "connect.html";
}



// $mysqli = mysqli_connect("example.com", "user", "password", "database");
// $result = mysqli_query($mysqli, "SELECT 'A world full of ' AS _msg FROM DUAL");
// $row = mysqli_fetch_assoc($result);
// echo $row['_msg'];


// $_POST['bbsTitle'], $_POST['bbsPassword'], $_POST['bbsName'], $_POST['bbsTel'], $_POST['bbsEmail'], $_POST['bbsContent']

echo $sql;
?>

<!-- http://39.127.118.32/%ED%99%88/test.php -->