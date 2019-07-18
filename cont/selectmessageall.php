<?php 
    require_once('../mysql/connect.php');
    $sql='SELECT m.messageId,m.userId,m.title,m.content,m.created_at,m.updated_at,u.account FROM message m join user u ON(m.userid=u.userid) order by m.messageId desc';
    $pre=$mysqli->prepare($sql);
    $pre->execute();
    $pre->store_result();
    $pre->bind_result($messageId,$userId,$title,$content,$created_at,$updated_at,$account);
    // $messageItem=new messageItem;
    $messageList=[];
    // echo $pre->num_rows;
    if($pre->num_rows>0){
        while($pre->fetch()){
            $messageItem=new messageItem;
            $messageItem->messageId=$messageId;
            $messageItem->userId=$userId;
            $messageItem->title=$title;
            $messageItem->content=$content;
            $messageItem->created_at=$created_at;
            $messageItem->updated_at=$updated_at;
            $messageItem->account=$account;
            $messageList[]=$messageItem;
            // echo $messageId."<br>";
            // echo $userId."<br>";
            // echo $title."<br>";
            // echo $content."<br>";
            // echo $created_at."<br>";
            // echo $updated_at."<br>";
            // var_dump($messageItem);
        }
        $loginUserId=(isset($_SESSION['userId']))?$_SESSION['userId']:-1;
        
        $data=[
            'loginUserId'=>$loginUserId,
            'messageList'=>$messageList
        ];
            
        
            
        
        echo json_encode($data);
    }else{
        echo "wrong";
    }
    // var_dump(json_encode($messageList));
    
?>