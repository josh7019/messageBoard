<?php 
    //將註冊資料存進資料庫
    
    require_once('../mysql/connect.php');
    if(isset($_POST['account'])){
        $account=$_POST['account'];
        $password=$_POST['password'];
        $password=password_hash($passwore,PASSWORD_DEFAULT);
        $sql="INSERT INTO user (account,password) values(?,?)";
        // $account=$account;
        // $password=$password;
        $pre=$mysqli->prepare($sql);
        $pre->bind_param('ss',$account,$password);
        $pre->execute();
        // echo $pre->affected_rows;
        // echo ($pre->affected_rows>0)?'ok':'wrong';
        Header("Location:../views/login.html"); 
        exit;
    }

    
?>