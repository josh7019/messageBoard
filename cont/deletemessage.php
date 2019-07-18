<?php
    require_once('../mysql/connect.php');
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
            $sql="select userId from message where messageId={$messageId}";
            $result=$mysqli->query($sql);
                if($result->num_rows==1){
                    $item=$result->fetch_object();
                    if($item->userId==$userId){
                        $sql='delete from message where messageId=?';
                        $pre=$mysqli->prepare($sql);
                        $pre->bind_param('i',$messageId);
                        $pre->execute();
                        $data=['message'=>'刪除成功'];
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
                // if($_POST['messageId']==$_SESSION['userId']){
                //     $data=['message'=>'ok'];
                //     echo json_encode($data);
                // }else{
                //     $data=['message'=>'not'];
                //     echo json_encode($data);
                // }    
        }else{
            
        }
        
    
?>