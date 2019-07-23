<?php 
    include_once('../mysql/all.php');
    if(!isset($_SESSION['userId'])){
        $_SESSION['message']="請先登入";
        header('Location:../views/login.php');
        exit();
    }
    if(isset($_POST['content'])){
        $content=$_POST['content'];
        $messageId=$_POST['messageId'];
        $userId=$_SESSION['userId'];
        $content = htmlentities($content,ENT_NOQUOTES,"UTF-8");
        $reply_model=new Reply;
        $is_success=$reply_model->addOne($messageId,$userId,$content);
    }
    if(!$is_success){
        $_SESSION['message']='回覆失敗';
    }
    $location="Location:../cont/select_detail_message.php?messageId=$messageId";
    header($location);
?>