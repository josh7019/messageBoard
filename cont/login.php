<?php
    //登入檢查
    
    require_once('../mysql/all.php');
    
    if(isset($_POST['account']) && !(isset($_SESSION['userId']))){
        
        $account=$_POST['account'];
        $password=$_POST['password'];
        $user_model=new User;
        $user_item=$user_model->getOneByAccount($account);
        
        if(count($user_item)>0){
            // $row=[];
            // $pre->fetch();
            if(password_verify($password,$user_item['password'])){
                $_SESSION['account']=$user_item['account'];
                $_SESSION['userId']=$user_item['userId'];
                $_SESSION['message']='登入成功';
                header('Location:../views/index.php');
                exit();
            }else{
                $_SESSION['message']='登入失敗';
                header('Location:../views/login.php');
                exit();
            }
            // $row['account']=$getAccount;
            // $row['password']=$getPassword;
        }else{
            $_SESSION['message']='登入失敗';
                header('Location:../views/login.php');
                exit();
        }
        // echo $account;
        // echo $password;
        // exit;
    }else if(isset($_SESSION['userId'])){
        $_SESSION['message']='重複登入';
                header('Location:../views/index.php');
                exit();
    }else{
        $_SESSION['message']='登入失敗';
                header('Location:../views/login.php');
                exit();
    }



    // $sql="SELECT userId,account,password from user where account=?";
        // $pre=$mysqli->prepare($sql);
        // $pre->bind_param('s',$account);
        // $pre->execute();
        // $pre->store_result();

        // $pre->bind_result($userId,$getAccount,$getPassword);
        // $ret=new stdClass;
?>