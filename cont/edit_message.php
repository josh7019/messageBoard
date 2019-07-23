<?php
    require_once('../mysql/all.php');
        
    if(!isset($_POST['messageId']))
    {
            $data=['message'=>'failed'];
            echo json_encode($data);
            $_SESSION['message']='編輯失敗';
            exit();
    }

    $messgeId=$_POST['messageId'];
    $content=$_POST['content'];
    $title=$_POST['title'];
    $datetime= date("Y/m/d H:i:s");
    $message_model=new Message;
    $is_success=$message_model->updateOne($messgeId,$content,$title,$datetime);

        if($is_success==1)
        {
            $data=['message'=>$is_success];
            echo json_encode($data);
            $_SESSION['message']='編輯成功';
            exit();
        }else
        {
            $data=['message'=>$is_success];
            echo json_encode($data);
            $_SESSION['message']='編輯失敗';
            exit();
        }
    
    

?>