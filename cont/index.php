<?php
    include_once('../smarty/smarty_init.php');
    include_once('../mysql/all.php');
    if(isset($_SESSION['message'])){
        $alert_message=$_SESSION['message'];
    }else{
        $alert_message='';
    }
    $is_login=(isset($_SESSION['userId']))?true:false;

    $smarty->assign('is_login',$is_login);
    $smarty->assign('message',$alert_message);
    $smarty->display('../views/index.tpl');
    unset($_SESSION['message']);
?>