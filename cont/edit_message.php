<?php
    require_once('../mysql/all.php');
    
    if (!isset($_POST['messageId'])) {
        $data = ['message' =>'failed'];
        echo json_encode($data);
        $_COOKIE['message'] = '編輯失敗';
        exit();
    }

    $messgeId = $_POST['messageId'];
    $content = $_POST['content'];
    $title = $_POST['title'];
    $content  =  htmlentities($content, ENT_NOQUOTES, "UTF-8");
    $title  =  htmlentities($title, ENT_NOQUOTES, "UTF-8");
    $datetime =  date("Y/m/d H:i:s");

    if (checkToken()) {
        $message_model = new Message;
        $is_success = $message_model->updateOne($messgeId, $title, $content, $datetime);
        if ($is_success == 1) {
            
            $data = ['message' =>$is_success];
            echo json_encode($data);
            setcookie ("message", '編輯成功', time()+3600 );
            exit();
        } else {
            $data = ['message' =>$is_success];
            echo json_encode($data);
            setcookie ("message", '編輯失敗', time()+3600 );
            exit();
        }
    } else {
        header('location:../cont/login_smarty.php');
    }

