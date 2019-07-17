<?php
    require_once('../mysql/connect.php');
    unset($_SESSION['userId'],$_SESSION['account']);
    header('Location:../views/login.php');
    $_SESSION['message']='登出成功';
    exit();
?>