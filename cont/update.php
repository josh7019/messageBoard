<?php
    include_once('../smarty/smarty_init.php');
    include_once('../mysql/all.php');

    if (!isset($_GET['messageId'])) {
        header('Location:../cont/index.php');
        setcookie("message", '留言不存在', time()+3600);
        exit();
    }

    $messageId_patt = '/^[0-9]{1,}$/';
    $messageId = $_GET['messageId'];
    if (!preg_match($messageId_patt, $messageId)) {
        header('Location:../cont/index.php');
        setcookie("message", '留言不存在', time()+3600);
        exit();
    }

    $message_item = getOneMessageDetail($messageId);
    if (!$message_item['messageId']) {
        header('Location:../cont/index.php');
        setcookie("message", '留言不存在', time()+3600);
        exit();
    }

    if (isset($_COOKIE['message'])) {
        $alert_message = $_COOKIE['message'];
    } else {
        $alert_message = '';
    }

    $user_item = checkToken();
    $is_login = ($user_item)?true:false;
    if ($user_item['userId'] != $message_item['userId']) {
        header('Location:../cont/index.php');
        setcookie("message", '非本人', time()+3600);
        exit();
    }

    $smarty->assign('is_login', $is_login);
    $smarty->assign('message', $alert_message);
    $smarty->display('../views/update.tpl');
?>