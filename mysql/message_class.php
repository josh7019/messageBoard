<?php
     include_once('model.php');
     
     class Message extends Model 
     {
        private $table='message';        
        
        ##取得所有留言資料
        public function getAll()
        {
            $messageList=$this->selectAll($this->table,['*']);
            return $messageList;
        }

        ##取得所有留言資料與細節
        public function getAllMessageDetail($loginUserId)
        {
            $messageList=$this->getAll();
            foreach($messageList as $index => $messageItem){            
                $user=new User;
                $userItem=$user->getOneByUserId($messageItem['userId']);
                $messageList[$index]['account']=$userItem['account'];
                $thumb=new Thumb;
                $thumb_count=$thumb->getOneCount($messageItem['messageId']);
                $messageList[$index]['thumb_count']=$thumb_count;
                
                $is_thumb=$thumb->getOne($messageItem['messageId'],$loginUserId);
                $is_thumb=(count($is_thumb)>0)?true:false;
                $messageList[$index]['is_thumb']=$is_thumb;
            }
            return $messageList;
        }

        ##取得單筆留言資料
        public function getOne($messageId)
        {
            $messageItem=$this->selectSingle($this->table,['*'],['messageId'],[$messageId],'i');
            return $messageItem;
        }
        
        ##取得單筆留言資料與細節
        public function getOneMessageDetail($messageId)
        {
            $messageItem=$this->getOne($messageId);
            $user=new User;
            $userItem=$user->getOne($messageItem['userId']);
            $messageItem['account']=$userItem['account'];
            $thumb=new Thumb;
            $thumb_count=$thumb->getOneCount($messageItem['userId']);
            $messageItem['thumb_count']=$thumb_count;
            return $messageItem;
        }

        ##新增一筆留言
        function addOne($userId,$title,$content)
        {
            $title=replaceChar($title);
            $content=replaceChar($content);
            $is_success=$this->insertInto($this->table,['userId','title','content'],[$userId,$title,$content],'iss');
            return $is_success;
        }


        ##刪除一筆留言
        function deleteOne($messageId)
        {
            $is_success=$this->delete($this->table,['messageId'],[$messageId],'i');
            return $is_success;
        }

        ##更新一筆留言
        function updateOne($messageId,$title,$content,$updated_at)
        {
            $is_success=$this->update($this->table,['title','content','updated_at'],[$title,$content,$updated_at],['messageId'],[$messageId],'sssi');
            return $is_success;
        }
    }






?>