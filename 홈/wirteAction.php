<!-- 문의사항 데이터베이스 전송 -->

<?php 
include $_SERVER['DOCUMENT_ROOT']."db.php";


function escape_and_replace_string($str){
    $str = mysqli_real_escape_string($conn, $str);
    $str = str_replace(array(" ","<",">","\n"),array("&nbsp;","&lt;","&gt;","<br>"),$str);
}


if(isset($_POST['bbsLock'])){ //잠금여부
    $lock = '1';
}else{
    $lock = '0';
}

$filtered = array(
    'title'=>escape_and_replace_string($_POST['bbsTitle']),
    'content'=>escape_and_replace_string($_POST['bbsContent']),
    'name'=>escape_and_replace_string($_POST['bbsName']),
    'tel'=>escape_and_replace_string($_POST['bbsTel']),
    'email'=>escape_and_replace_string($_POST['bbsEmail']),
    'password'=>escape_and_replace_string($_POST['bbsPassword']),
    'lock'=>escape_and_replace_string($_POST['bbsLock']),
    'file'=>escape_and_replace_string($_POST['bbsFile'])
);

$tmpfile = $_FILES['bbsFile']['tmp_name']; //$_FILES['파일]으로 POST로 받아온 파일을 tmp_name으로 임시 파일명 바꾸기
$o_name = $_FILES['bbsFile']['name']; //원래 파일명
$filename = iconv("UTF-8","EUC-KR",$_FILES['bbsFile']['name']); //한글파일깨짐 방지
$folder = "/upload/".$filename;
move_uploaded_file($tmpfile,$folder);

//$bbsID = (int);//마지막 번호를 데이터베이스에서 받아와서 +1

if($title==null || $content==null || $name==null || $tel==null || $email==null || $password==null){
    echo "<script>alert('입력이 안된 부분이 있습니다.')";
    echo "history.back();</script>"
}else{
    $sql = "INSERT INTO bbs(bbsId, bbsTitle, bbsDate, bbsContent, bbsAvailable, bbsName, bbsTel, bbsEmail, bbsPassword, bbsLock, bbsFile)
    VALUES($bbsID, '{$filtered['title']}', NOW(), '{$filtered['content']}', 1, '{$filtered['name']}', '{$filtered['tel']}', '{$filtered['email']}', '{$filtered['password']}', '$lock','$o_name')"; //12/28 echo 출력 결과 content를 못 읽어옴

    $result = mq($sql); //데이터베이스 전송
    if($result == false){
        echo "<script>alert('글쓰기에 실패했습니다.');
              history.back();</script>";
    }else{
        echo "<script>alert('정상적으로 등록되었습니다.');
              location.href='connect.php'</script>";
    }
}

?>

<!-- http://39.127.118.32/%ED%99%88/test.php -->

<!-- 
// php
// $mysqli = mysqli_connect("example.com", "user", "password", "database");
// $result = mysqli_query($mysqli, "SELECT 'A world full of ' AS _msg FROM DUAL");
// $row = mysqli_fetch_assoc($result); =>연관 배열 Array ( [seq] => 1 [name] => 홍길동 )
// $row = mysqli_fetch_row($result); =>일반 배열
// echo $row['_msg']; 
-->