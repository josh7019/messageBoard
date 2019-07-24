<?php 
    include_once('../smarty/smarty_init.php');
    include_once('../mysql/all.php');
        if(!isset($_GET['messageId']))
        {
            setcookie ("message",'留言不存在', time () + 3600 );
        }
    $messageId=$_GET['messageId'];
    $message_model=new Message;
    $message_item=getOneMessageDetail($messageId);
    
    
    $reply_model=new Reply;
    $reply_list=$reply_model->getReplysByMessageId($messageId);
    foreach($reply_list as $index=>$reply_item){
        $user_model=new User;
        $user_item=$user_model->getOneByUserId($reply_item['userId']);
        $reply_list[$index]['account']=$user_item['account'];
    }
    $reply_count=$reply_model->getCount($messageId);
    $user_item=checkToken();
    $is_login=($user_item)?true:false;
    $smarty->assign('is_login',$is_login);
    $smarty->assign('reply_count',$reply_count);
    $smarty->assign('message_detail',$message_item);
    $smarty->assign('messageId',$messageId);
    $smarty->assign('reply_list',$reply_list);
    $smarty->display('../views/message_detail.tpl');
    // setcookie ("message", 0, time () + 3600 );
?>