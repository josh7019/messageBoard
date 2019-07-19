<?php 
    require_once('../mysql/connect.php');
    if(!isset($_POST['addOrRemove'])){
        exit();
    }else{
        $messageId=$_POST['messageId'];
        $userId=$_SESSION['userId'];
        $addOrRemove=$_POST['addOrRemove'];
    }
    if($addOrRemove=='add'){
        $sql='insert into thumb (messageId,userId) values (?,?)';
        $pre=$mysqli->prepare($sql);
        $pre->bind_param('ii',$messageId,$userId);
        $pre->execute();
        echo "insert";
    }else if($addOrRemove=='remove'){
        $sql='delete from thumb where messageId=? and userId=?';
        $pre=$mysqli->prepare($sql);
        $pre->bind_param('ii',$messageId,$userId);
        $pre->execute();
        echo "delete";
    }
?>