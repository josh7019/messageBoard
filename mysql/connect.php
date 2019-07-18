<?php
    date_default_timezone_set('Asia/Taipei');
    session_start();
    $mysqli=new mysqli("localhost",'root','','messageboard2');
    $mysqli->set_charset('utf-8');
    


    class messageItem{
        public $messageId;
        public $userId;
        public $account;
        public $title;
        public $content;
        public $created_at;
        public $updated_at;
    }
?>