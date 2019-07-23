<?php 
    //將註冊資料存進資料庫
    
    require_once('../mysql/all.php');
    if(isset($_POST['account'])&&!(isset($_SESSION['userId'])))
    {
        $account=$_POST['account'];
        $password=$_POST['password'];
        $password=password_hash($password,PASSWORD_DEFAULT);
        $user_model=new User;
        $is_success=$user_model->signup($account,$password);
        if($is_success)
        {
            $_SESSION['message']='註冊成功';
            Header("Location:../views/login.php"); 
            exit;
        }else
        {
            $_SESSION['message']='註冊失敗';
            Header("Location:../views/signup.php"); 
            exit;
        }        
       
    }else if(isset($_SESSION['userId']))
    {
        $_SESSION['message']='請先登出再註冊 ';
                header('Location:../views/index.php');
                exit();
    }else
    {
        $_SESSION['message']='註冊失敗';
        Header("Location:../views/signup.php"); 
    }

?>