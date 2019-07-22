<?php
     include_once('model.php');
     
     class Message extends Model {
        private $table='message';        
        
        ##取得所有留言資料
        public function get_all(){
            $messageList=$this->select_all($this->table,['*']);
            return $messageList;
        }

        ##取得所有留言資料與細節
        public function get_all_detail($loginUserId){
            $messageList=$this->get_all();
            foreach($messageList as $index => $messageItem){            
                $user=new User;
                $userItem=$user->get_one($messageItem['userId']);
                $messageList[$index]['account']=$userItem['account'];
                $thumb=new Thumb;
                $thumb_count=$thumb->get_one_count($messageItem['userId']);
                $messageList[$index]['thumb_count']=$thumb_count;
                
                $is_thumb=$thumb->get_one($messageItem['messageId'],$loginUserId);
                $is_thumb=(count($is_thumb)>0)?true:false;
                $messageList[$index]['is_thumb']=$is_thumb;
            }
            return $messageList;
        }

        ##取得單筆留言資料
        public function get_one($messageId){
            $messageItem=$this->select_single($this->table,['*'],['messageId'],[$messageId],'i');
            return $messageItem;
        }
        
        ##取得單筆留言資料與細節
        public function get_one_detail($messageId){
            $messageItem=$this->get_one($messageId);
            $user=new User;
            $userItem=$user->get_one($messageItem['userId']);
            $messageItem['account']=$userItem['account'];
            $thumb=new Thumb;
            $thumb_count=$thumb->get_one_count($messageItem['userId']);
            $messageItem['thumb_count']=$thumb_count;
            return $messageItem;
        }

        ##新增一筆留言
        function add_one($userId,$title,$content){
            $title=replaceChar($title);
            $content=replaceChar($content);
            $is_success=$this->insert_into($this->table,['userId','title','content'],[$userId,$title,$content],'iss');
            return $is_success;
        }


        ##刪除一筆留言
        function delete_one($messageId){
            $is_success=$this->delete($this->table,['messageId'],[$messageId],'i');
            return $is_success;
        }
    }






?>