<?php
    require_once('../mysql/connect.php');
    require_once('../command.php');
    if(isset($_POST['title'])&&(isset($_SESSION['userId']))){
        $userId=$_SESSION['userId'];
        $title=$_POST['title'];
        $content=$_POST['content'];
        $title=replaceChar($title);
        $content=replaceChar($content);
        // echo $title."<br>";
        // echo $content."<br>";
        $sql="INSERT INTO message (userId,title,content) values(?,?,?)";
        $pre=$mysqli->prepare($sql);
        $pre->bind_param('iss',$userId,$title,$content);
        $pre->execute();
        // echo $pre->affected_rows;
        $_SESSION['message']='新增成功';
        header('Location:../views/index.php');
    }else if(!isset($_SESSION['userId'])){
        $_SESSION['message']='請先登入';
        header('Location:../views/login.php');
    }
    else{
        $_SESSION['message']='新增失敗';
        header('Location:../views/index.php');
    }
?>