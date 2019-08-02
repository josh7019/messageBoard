<?php
    include_once('../mysql/all.php');
    ##判斷是否登入
    $user_item = checkToken();
    $loginUserId = ($user_item) ? $user_item['userId'] : -1;
    try {
        $message_model = new Message;
        $message_list_detail = getAllMessageDetail($loginUserId);
        $data = [
            'loginUserId' => $loginUserId,
            'messageList' => $message_list_detail
        ];
    echo json_encode($data);
    } catch (Exception $e) {
        echo "wrong:{$e->getMessage}";
    }
