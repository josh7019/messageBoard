<?php
    require_once('../mysql/all.php');
    // unset($_COOKIE['userId'],$_COOKIE['account']);
    setcookie ("token", "test", time () - 100 );
    header('Location:../cont/index.php');
    setcookie ("message",'登出成功', time () + 3600 );
    exit();
?>