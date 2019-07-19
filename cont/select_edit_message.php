<?php
    require_once('../mysql/connect.php');
    if(!isset($_POST['messageId'])){
        $_SESSION['message']='留言不存在';
    }
    $messageId=$_POST['messageId'];
    $sql='SELECT m.messageId,m.userId,m.title,m.content,m.created_at,m.updated_at,u.account FROM message m join user u ON(m.userid=u.userid) where messageId=?';
    $sql="select * from message where messageId=?";
    $pre=$mysqli->prepare($sql);
    $pre->bind_param('i',$messageId);
    $pre->execute();
    $pre->store_result();
    if($pre->num_rows==1){
        $pre->bind_result($messageId,$userId,$title,$content,$created_at,$updated_at,$account);
        $pre->fetch();
        $messageItem=new messageItem;
            $messageItem->messageId=$messageId;
            $messageItem->userId=$userId;
            $messageItem->title=$title;
            $messageItem->content=$content;
            $messageItem->created_at=$created_at;
            $messageItem->updated_at=$updated_at;
            $messageItem->account=$account;
            $data=$messageItem;
    }

    
    // // echo $data;
    // echo json_encode($data);


    // require_once('../mysql/Model.php');
    // if(!isset($_POST['messageId'])){
    //     $_SESSION['message']='留言不存在';
    // }
    // $messageId=$_POST['messageId'];
    // $model=new Model;
    // $message
?>