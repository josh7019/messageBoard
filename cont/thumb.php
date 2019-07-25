<?php 
    require_once('../mysql/all.php');

    if (!isset($_POST['addOrRemove'])) {
        exit();
    } else {
        $messageId = $_POST['messageId'];
        $user_item = checkToken();
        $userId = $user_item['userId'];
        $addOrRemove = $_POST['addOrRemove'];
    }

    if ($addOrRemove == 'add') {
        $thumb_model = new Thumb;
        $is_success = $thumb_model->addOne($messageId, $userId);     
        echo ($is_success) ? "insert" : "fail insert";
    } elseif ($addOrRemove == 'remove') {
        $thumb_model = new Thumb;
        $is_success = $thumb_model->removeThumb($messageId, $userId);        
        echo ($is_success) ? "delete" : "fail delete";
    }


?>