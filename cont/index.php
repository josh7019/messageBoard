<?php
    include_once('../smarty/smarty_init.php');
    include_once('../mysql/all.php');

    if(isset($_COOKIE['message'])){
        $alert_message = $_COOKIE['message'];
    }else{
        $alert_message = '';
    }
    $user_item=checkToken();
    $is_login = (checkToken())?true:false;

    $smarty->assign('is_login', $is_login);
    $smarty->assign('message', $alert_message);
    $smarty->display('../views/index.tpl');
?>