<?php 
    //將註冊資料存進資料庫
    
    require_once('../mysql/connect.php');
    if(isset($_POST['account'])&&!(isset($_SESSION['userId']))){
        $account=$_POST['account'];
        $password=$_POST['password'];
        $password=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO user (account,password) values(?,?)";
        // $account=$account;
        // $password=$password;
        // $test="0000";
        // var_dump(password_verify($test,$password));
        // exit();
        
        $pre=$mysqli->prepare($sql);
        $pre->bind_param('ss',$account,$password);
        $pre->execute();
        // echo $pre->affected_rows;
        // echo ($pre->affected_rows>0)?'ok':'wrong';
        $_SESSION['message']='註冊成功';
        Header("Location:../views/login.php"); 
        exit;
    }else if(isset($_SESSION['userId'])){
        $_SESSION['message']='請先登出再註冊';
                header('Location:../views/index.php');
                exit();
    }else{
        $_SESSION['message']='註冊失敗';
        Header("Location:../views/signup.php"); 
    }

    
?>