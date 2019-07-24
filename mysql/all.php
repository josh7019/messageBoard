<?php 
    require_once('Model.php');
    require_once('message_class.php');
    require_once('reply_class.php');
    require_once('thumb_class.php');
    require_once('user_class.php');
    
    setcookie('message',0,time()+3600);
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


    function getToken()
    {
        $random_string='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token_string='';
        for($i=0;$i<250;$i++){
            $token_string.=substr($random_string,rand(0,strlen($random_string)-1),1);
    
        }
        return $token_string;
    }

    function checkToken()
    {
        if(isset($_COOKIE['token']))
            {
                $token=$_COOKIE['token'];
                $user_model=new User;
                $user_item=$user_model->getUserByToken($token);
                ##判斷token是否取到資料
                if(count($user_item)>0)
                {
                    return $user_item;
                }else
                {
                    setcookie ("token", "delete", time () - 100 );
                    return false;
                }
            }else
            {
                return false;
            }
    }
?>