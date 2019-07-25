<?php
    require_once('../mysql/all.php');
    require_once('../command.php');

    if(isset($_POST['title'])&&(checkToken())){
        $user_item = checkToken();
        $userId = $user_item['userId'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $message_model = new Message;
        $is_success = $message_model->addOne($userId, $title, $content);
        setcookie("message", '新增成功', time()+3600 );
        header('Location:../cont/index.php');
    }elseif(!checkToken()){
        setcookie ("message", '請先登入', time()+3600 );
        header('Location:../cont/login_smarty.php');
    }
    else{
        setcookie ("message", '新增失敗', time()+3600 );
        header('Location:../cont/index.php');
    }

?>