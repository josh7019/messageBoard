<?php
    include_once('../smarty/smarty_init.php');
    include_once('../mysql/all.php');
    $user_item=checkToken();
    if(isset($_COOKIE['message'])){
        $alert_message=$_COOKIE['message'];
    }else{
        $alert_message='';
    }
    
    $user_item=checkToken();
    $is_login=($user_item)?true:false;

    $smarty->assign('is_login',$is_login);
    $smarty->assign('message',$alert_message);
    $smarty->display('../views/signup.tpl');
    // setcookie ("message", 0, time () + 3600 );
?>