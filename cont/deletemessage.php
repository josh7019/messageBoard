<?php
    require_once('../mysql/all.php');
    
        if (!isset($_POST['messageId'])) {
            $data = ['message' => '刪除失敗,留言不存在'];
            echo json_encode($data);
            exit();
        } elseif (!checkToken()) {
            $data = ['message' => '刪除失敗,請先登入'];
            echo json_encode($data);
            exit();
        }

        if (isset($_POST['messageId']) && (checkToken())) {
            $user_item = checkToken();
            $messageId = $_POST['messageId'];
            $userId = $user_item['userId'];
            $message_model = new Message();
            $message_item = $message_model->getOne($messageId);
            if ($message_item['userId'] != $user_item['userId']) {
                $data = ['message' => '非本人'];
                echo json_encode($data);
                exit();
            }

            if (count($message_item)>0) {
                if ($message_item['userId'] == $userId) {
                    $is_success = $message_model->deleteOne($messageId);
                    $data = ['message' => ($is_success)?'刪除成功':'刪除失敗'];
                    echo json_encode($data);
                } else {
                    $data = ['message' => '刪除失敗'];
                    echo json_encode($data);
                    exit();
                }
            } else {
                $data = ['message' => '刪除失敗,留言不存在'];
                echo json_encode($data);
                exit();
            }
        } else {
            $data = ['message' => '刪除失敗'];
            echo json_encode($data);
            exit();
        }

