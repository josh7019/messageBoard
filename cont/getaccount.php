<?php     
    // 檢查是否有相同帳號
    
    require_once('../mysql/connect.php');
    if(isset($_POST['account'])){
        $account=$_POST['account'];
        $sql="select * from user where account='{$account}'";
        $result=$mysqli->query($sql);
        // $pre=$mysqli->prepare($sql);
        // $pre->bind_param('s',$account);
        // $pre->execute(); 
        // echo $pre->num_rows;
        echo $result->num_rows;
    }else{
        echo 'wrong';
    }
?>