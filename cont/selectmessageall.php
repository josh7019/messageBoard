<?php
    include_once('../mysql/all.php');
    ##判斷是否登入
    $loginUserId=(isset($_SESSION['userId']))?$_SESSION['userId']:-1;
    try {
        $message_model=new Message;
    $message_list_detail=$message_model->get_all_detail($loginUserId);
    // var_dump($message_list_detail);
    
    $data=[
        'loginUserId'=>$loginUserId,
        'messageList'=>$message_list_detail
    ];
    echo json_encode($data);
    } catch(Exception $e){
        echo "wrong:{$e->getMessage}";
    }
    
?>