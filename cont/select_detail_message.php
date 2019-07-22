<?php 

        require_once('../mysql/all.php');
        if(!isset($_POST['messageId'])){
            $_SESSION['message']='留言不存在';
        }
        $messageId=$_POST['messageId'];
        $message_model=new Message;
        $message_item=$message_model->getOneMessageDetail($messageId);
        echo json_encode($message_item);
            

?>