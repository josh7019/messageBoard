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

?>