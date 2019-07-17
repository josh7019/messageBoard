<?php
    //登入檢查
    
    require_once('../mysql/connect.php');
    
    if(isset($_POST['account'])){
        
        $account=$_POST['account'];
        $password=$_POST['password'];
        // var_dump($account);
        // exit;
        $sql="SELECT userId,account,password from user where account=?";
        $pre=$mysqli->prepare($sql);
        $pre->bind_param('s',$account);
        $pre->execute();
        $pre->store_result();
        // echo $pre->affected_rows;
        // echo ($pre->affected_rows>0)?'ok':'wrong';
        // Header("Location:../views/login.html");
        // $test=$pre->fetch();
        // var_dump($test);
        // echo $pre->num_rows;
        $pre->bind_result($userId,$getAccount,$getPassword);
        $ret=new stdClass;
        if($pre->num_rows==1){
            // $row=[];
            $pre->fetch();
            if(password_verify($password,$getPassword)){
                $_SESSION['account']=$account;
                $_SESSION['userId']=$userId;
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
    }
?>