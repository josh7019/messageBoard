<?php
     class Message extends Model 
     {
        private $table = 'message';

        /*
        * 取得所有留言資料
        */ 
        public function getAll()
        {
            $messageList = $this->selectAll($this->table, ['*']);
            return $messageList;
        }

        /*
        * 取得單筆留言資料
        */
        public function getOne($messageId)
        {
            $messageItem = $this->selectSingle(
                $this->table,
                ['*'],
                ['messageId'],
                [$messageId],
                'i'
            );
            return $messageItem;
        }
        
        /*
        * 新增一筆留言
        */
        function addOne($userId, $title, $content)
        {
            $title = replaceChar($title);
            $content = replaceChar($content);
            $is_success = $this->insertInto(
                $this->table,
                ['userId', 'title', 'content'],
                [$userId, $title, $content],
                'iss'
            );
            return $is_success;
        }

        /*
        * 刪除一筆留言
        */
        function deleteOne($messageId)
        {
            $is_success = $this->delete(
                $this->table,
                ['messageId'],
                [$messageId],
                'i'
            );
            return $is_success;
        }

        /*
        * 更新一筆留言
        */
        function updateOne($messageId, $title, $content, $updated_at)
        {
            $is_success = $this->update(
                $this->table,
                ['title', 'content', 'updated_at'],
                [$title, $content, $updated_at],
                ['messageId'], [$messageId],
                'sssi'
            );
            return $is_success;
        }
    }
