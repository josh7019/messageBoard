<?php 
    include_once('../mysql/all.php');
    if(!checkToken()){
        setcookie ("message","請先登入", time () + 3600 );
        header('Location:../cont/login_smarty.php');
        exit();
    }
    if(isset($_POST['content'])){
        $user_item=checkToken();
        $content=$_POST['content'];
        $messageId=$_POST['messageId'];
        $userId=$user_item['userId'];
        $content = htmlentities($content,ENT_NOQUOTES,"UTF-8");
        $reply_model=new Reply;
        $is_success=$reply_model->addOne($messageId,$userId,$content);
    }
    if(!$is_success){
        setcookie ("message",'回覆失敗', time () + 3600 );
    }
    $location="Location:../cont/select_detail_message.php?messageId=$messageId";
    header($location);
?>