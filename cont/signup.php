<?php 
    //將註冊資料存進資料庫
    require_once('../mysql/all.php');

    $user_item = checkToken();
    if(isset($_POST['account'])&&!($user_item)){
        $account = $_POST['account'];
        $password = $_POST['password'];
        $account_patt = "/^[a-zA-Z][a-zA-Z0-9]{6,20}$/";
        $password_patt = '/^[a-zA-Z0-9]{4,20}$/';
        $is_account_right = preg_match($account_patt, $account);
        $is_password_right = preg_match($password_patt, $password);
        if(!$is_account_right){
            setcookie ("message", '帳號格式錯誤', time()+3600);
            Header("Location:../cont/signup_smarty.php");
            exit();
        }

        if(!$is_password_right){
            setcookie ("message", '密碼格式錯誤', time()+3600 );
            Header("Location:../cont/signup_smarty.php");
            exit();
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $user_model = new User;
        $is_success = $user_model->signup($account, $password);
        if($is_success){
            setcookie ("message", '註冊成功', time()+3600);
            Header("Location:../cont/login_smarty.php"); 
            exit;
        }else{
            setcookie ("message", '註冊失敗', time()+3600);
            Header("Location:../cont/signup_smarty.php"); 
            exit;
        }

    }else if($user_item){
        setcookie ("message", '請先登出再註冊', time()+3600);
        header('Location:../cont/index.php');
        exit();
    }else{
        setcookie ("message", '註冊失敗', time()+3600);
        Header("Location:../../cont/signup_smarty.php"); 
    }

?>