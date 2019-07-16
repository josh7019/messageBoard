<?php
    require_once('../mysql/connect.php');
    
    if(isset($_POST['account'])){
        
        $account=$_POST['account'];
        $password=$_POST['password'];
        // var_dump($account);
        // exit;
        $sql="SELECT * from user where account=?";
        $pre=$mysqli->prepare($sql);
        $pre->bind_param('s',$account);
        $pre->execute();
        $pre->store_result();
        // echo $pre->affected_rows;
        // echo ($pre->affected_rows>0)?'ok':'wrong';
        // Header("Location:../views/login.html");
        // $test=$pre->fetch();
        // var_dump($test);
        echo $pre->num_rows;
                            // $pre->bind_result()
        // echo $account;
        // echo $password;
        // exit;
    }
?>