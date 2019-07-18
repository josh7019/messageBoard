<?php 

        require_once('../mysql/connect.php');
        if(!isset($_POST['messageId'])){
            $_SESSION['message']='留言不存在';
        }
        $messageId=$_POST['messageId'];
        $sql='SELECT m.messageId,m.userId,m.title,m.content,m.created_at,m.updated_at,u.account FROM message m join user u ON(m.userid=u.userid) where messageId=?';
        // $sql="select * from message where messageId=?";
        $pre=$mysqli->prepare($sql);
        $pre->bind_param('i',$messageId);
        $pre->execute();
        $pre->store_result();

        $sql2='select count(*) from thumb where messageId=?';
        $pre2=$mysqli->prepare($sql2);
        $pre2->bind_param('i',$messageId);
        $pre2->execute();
        $pre2->store_result();

        if($pre->num_rows==1){
            $pre->bind_result($messageId,$userId,$title,$content,$created_at,$updated_at,$account);
            $pre2->bind_result($thumbCount);
            $pre->fetch();
            $pre2->fetch();
            $messageItem=new messageItem;
                $messageItem->messageId=$messageId;
                $messageItem->userId=$userId;
                $messageItem->title=$title;
                $messageItem->content=$content;
                $messageItem->created_at=$created_at;
                $messageItem->updated_at=$updated_at;
                $messageItem->account=$account;
                $messageItem->thumbCount=$thumbCount;
                $data=$messageItem;
        }


        // echo $data;
        echo json_encode($data);
            

?>