<?php
    //登入檢查

    require_once('../mysql/all.php');
    include_once('../smarty/smarty_init.php');


    if(isset($_POST['account']) && !(checkToken())){ 
        $account = $_POST['account'];
        $password = $_POST['password'];
        $user_model = new User;
        $user_item = $user_model->getOneByAccount($account);   
        if(count($user_item)>0){
            if(password_verify($password, $user_item['password'])){
                $token = getToken();
                setcookie('token', $token, time()+3600);
                $user_model = new User;
                $is_success = $user_model->addToken($token, $user_item['userId'], $user_item['account']);
                setcookie ("message", '登入成功', time()+3600 );
                header('Location:../cont/index.php');
                exit();
            }else{
                setcookie ("message", '登入失敗', time()+3600 );
                header('Location:../cont/login_smarty.php');
                exit();
            }

        }else{
            setcookie ("message", '登入失敗', time()+3600 );
                header('Location:../cont/login_smarty.php');
                exit();
        }

    }elseif(checkToken()){
        setcookie ("message", '重複登入',time()+3600 );
                header('Location:../cont/index.php');
                exit();
    }else{
        setcookie ("message", '登入失敗', time()+3600 );
                header('Location:../cont/login_smarty.php');
                exit();
    }

?>