<?php
    require_once('../mysql/all.php');
    if(!isset($_POST['messageId'])){
        setcookie ("message",'留言不存在', time()+3600);
    }

    $messageId = $_POST['messageId'];
    $message_model = new Message;
    $message_item = getOneMessageDetail($messageId);
    if($message_item['title']){       
        echo json_encode($message_item);
    }else{
        echo "wrong";
    }

?>