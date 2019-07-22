<?php
    require_once('../mysql/all.php');
        if(!isset($_POST['messageId'])){
            $data=['message'=>'刪除失敗,留言不存在'];
            echo json_encode($data);
            exit();
        }else if(!isset($_SESSION['userId'])){
            $data=['message'=>'刪除失敗,請先登入'];
            echo json_encode($data);
            exit();
        }
      
    if(isset($_POST['messageId'])&&(isset($_SESSION['userId']))){
            $messageId=$_POST['messageId'];
            $userId=$_SESSION['userId'];
            $message_model=new Message();
            $message_item=$message_model->get_one($messageId);
            
                if(count($message_item)>0){
                    if($message_item['userId']==$userId){
                        $is_success=$message_model->delete_one($messageId);
                        $data=['message'=>($is_success)?'刪除成功':'刪除失敗'];
                        echo json_encode($data);
                    }else{
                        $data=['message'=>'刪除失敗'];
                        echo json_encode($data);
                        exit();
                    }
                }else{
                    $data=['message'=>'刪除失敗,留言不存在'];
                    echo json_encode($data);
                    exit();
                }
                  
        }else{
            $data=['message'=>'刪除失敗'];
                    echo json_encode($data);
                    exit();
        }
        
    
?>