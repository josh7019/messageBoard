<?php
    require_once('../mysql/all.php');

    setcookie ("token", "test", time()-100);
    header('Location:../cont/index.php');
    setcookie ("message", '登出成功', time()+3600);
    exit();
?>