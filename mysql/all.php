<?php 
    require_once('Model.php');
    require_once('message_class.php');
    require_once('reply_class.php');
    require_once('thumb_class.php');
    require_once('user_class.php');

    ##取得所有留言資料與細節
    function getAllMessageDetail($loginUserId)
    {
        $message=new Message;
        $messageList=$message->getAll();
        foreach($messageList as $index => $messageItem){            
            $user=new User;
            $userItem=$user->getOneByUserId($messageItem['userId']);
            $messageList[$index]['account']=$userItem['account'];
            $thumb=new Thumb;
            $thumb_count=$thumb->getOneCount($messageItem['messageId']);
            $messageList[$index]['thumb_count']=$thumb_count;
            
            $is_thumb=$thumb->getOne($messageItem['messageId'],$loginUserId);
            $is_thumb=(count($is_thumb)>0)?true:false;
            $messageList[$index]['is_thumb']=$is_thumb;
        }
        return $messageList;
    }

    ##取得單筆留言資料與細節
    function getOneMessageDetail($messageId)
    {
        $message=new message;
        $messageItem=$message->getOne($messageId);
        $user=new User;
        $userItem=$user->getOneByUserId($messageItem['userId']);
        $messageItem['account']=$userItem['account'];
        $thumb=new Thumb;
        $thumb_count=$thumb->getOneCount($messageItem['userId']);
        $messageItem['thumb_count']=$thumb_count;
        return $messageItem;
    }
?>