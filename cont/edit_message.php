<?php
    require_once('../mysql/connect.php');
    if(!isset($_POST['messageId'])){
        $data=['message'=>'failed'];
        echo json_encode($data);
        $_SESSION['message']='編輯失敗';
        exit();
    }
    // echo json_encode($data);
    $messgeId=$_POST['messageId'];
    $content=$_POST['content'];
    $title=$_POST['title'];
    $datetime= date("Y/m/d H:i:s");
    $sql='update message set title=?,content=?,updated_at=? where messageId=?';
    $pre=$mysqli->prepare($sql);
    $pre->bind_param('sssi',$title,$content,$datetime,$messgeId);
    $pre->execute();
    if($pre->affected_rows==1){
        $data=['message'=>$pre->affected_rows];
        echo json_encode($data);
        $_SESSION['message']='編輯成功';
        exit();
    }else{
        $data=['message'=>$pre->affected_rows];
        echo json_encode($data);
        $_SESSION['message']='編輯失敗';
    }
    
    

?>