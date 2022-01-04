<?php //암호화 때문에 이렇게 함
    $conn = mysqli_connect("39.127.118.32","ymy","quiart","bbs"); //데이터베이스 연결

    function mq($sql){
        global $result=mysqli_query($conn,$sql);
        return $result;
    }

    function nextPage()




?>