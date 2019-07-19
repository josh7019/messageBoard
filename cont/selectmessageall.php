<?php 
    require_once('../mysql/connect.php');
    $sql='SELECT m.messageId,m.userId,m.title,m.content,m.created_at,m.updated_at,u.account FROM message m join user u ON(m.userid=u.userid) order by m.messageId desc';
    $pre=$mysqli->prepare($sql);
    $pre->execute();
    $pre->store_result();
    $pre->bind_result($messageId,$userId,$title,$content,$created_at,$updated_at,$account);
    // $messageItem=new messageItem;
    $messageList=[];
    $loginUserId=(isset($_SESSION['userId']))?$_SESSION['userId']:-1;
    
    

    // echo $pre->num_rows;
    if($pre->num_rows>0){
        
        while($pre->fetch()){
            $messageItem=new messageItem;
            ##取每筆留言讚數
            $sql3='select count(*) from thumb where messageId=?';
            $pre3=$mysqli->prepare($sql3);
            $pre3->bind_param('i',$messageId);
            $pre3->execute();
            $pre3->store_result();
            $pre3->bind_result($thumbCount);
            $pre3->fetch();
            $messageItem->thumbCount=$thumbCount;
            ##尚未完成區
            if(isset($_SESSION['userId'])){
               $sql2="SELECT * FROM thumb where userId=? and messageId=?";
               $pre2=$mysqli->prepare($sql2);
                $pre2->bind_param('ii',$loginUserId,$messageId);
                $pre2->execute();
                $pre2->store_result();
                $messageItem->isthumb=($pre2->num_rows>0)?true:false;
                // $messageItem->isthumb=$pre2->num_rows;
            }else{
                $messageItem->isthumb=false;
            }
            ##尚未完成區
            $messageItem->messageId=$messageId;
            $messageItem->userId=$userId;
            $messageItem->title=$title;
            $messageItem->content=$content;
            $messageItem->created_at=$created_at;
            $messageItem->updated_at=$updated_at;
            $messageItem->account=$account;
            // $messageItem->isTumb=$istumb;
            $messageList[]=$messageItem;
            // echo $messageId."<br>";
            // echo $userId."<br>";
            // echo $title."<br>";
            // echo $content."<br>";
            // echo $created_at."<br>";
            // echo $updated_at."<br>";
            // var_dump($messageItem);
        }
        
        
        
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