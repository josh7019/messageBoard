<?php
    require_once('../mysql/all.php');
    require_once('../command.php');
    
    if(isset($_POST['title'])&&(isset($_SESSION['userId'])))
    {
        $userId=$_SESSION['userId'];
        $title=$_POST['title'];
        $content=$_POST['content'];
        $message_model=new Message;
        $is_success=$message_model->addOne($userId,$title,$content);
        $_SESSION['message']='新增成功';
        header('Location:../views/index.php');
    }else if(!isset($_SESSION['userId']))
    {
        $_SESSION['message']='請先登入';
        header('Location:../views/login.php');
    }
    else
    {
        $_SESSION['message']='新增失敗';
        header('Location:../views/index.php');
    }

?>