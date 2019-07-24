<?php
    //登入檢查
    
    require_once('../mysql/all.php');
    include_once('../smarty/smarty_init.php');
        if(isset($_POST['account']) && !(isset($_SESSION['userId'])))
        { 
            $account=$_POST['account'];
            $password=$_POST['password'];
            $user_model=new User;
            $user_item=$user_model->getOneByAccount($account);
            
            if(count($user_item)>0)
            {
                
                if(password_verify($password,$user_item['password']))
                {
                    $_SESSION['account']=$user_item['account'];
                    $_SESSION['userId']=$user_item['userId'];
                    $token=getToken();
                    setcookie('token',$token,time()+3600);
                    $user_model=new user;
                    $is_success=$user_model->addToken($token,$user_item['userId'],$user_item['account']);
                    $_SESSION['message']='登入成功';
                    
                    header('Location:../cont/index.php');
                    exit();
                }else
                {
                    $_SESSION['message']='登入失敗';
                    header('Location:../cont/login_smarty.php');
                    exit();
                }
            }else
            {
                $_SESSION['message']='登入失敗';
                    header('Location:../cont/login_smarty.php');
                    exit();
            }
        }else if(isset($_SESSION['userId']))
        {
            $_SESSION['message']='重複登入';
                    header('Location:../cont/index.php');
                    exit();
        }else{
            $_SESSION['message']='登入失敗';
                    header('Location:../cont/login_smarty.php');
                    exit();
        }

        function getToken(){
            $random_string='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $token_string='';
            for($i=0;$i<250;$i++){
                $token_string.=substr($random_string,rand(0,strlen($random_string)-1),1);
        
            }
            return $token_string;
        }
?>