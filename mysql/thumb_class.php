<?php

    class Thumb extends Model
    {
        private $table = 'thumb';
        
        ## 按讚
        public function addOne($messageId, $userId)
        {
            $affected_rows = $this->insertInto($this->table, ['messageId', 'userId'], [$messageId, $userId], 'ii');
            return $affected_rows;
        }

        ## 取得user是否按讚
        public function getOne($messageId, $userId)
        {
            $thumb_Item = $this->selectSingle($this->table, ['*'], ['messageId', 'userId'], [$messageId, $userId], 'ii');
            return $thumb_Item;
        }

        ## 取得單筆留言讚數
        public function getOneCount($messageId)
        {    
            $thumb_Item = $this->selectSingle($this->table, ['count(*)'], ['messageId'], [$messageId], 'i');
            return $thumb_Item['count(*)'];
        }
        
        ## 移除讚
        public function removeThumb($messageId, $userId)
        {
            $is_success = $this->delete($this->table, ['messageId', 'userId'], [$messageId, $userId], 'ii');
            return $is_success;
        }
    }

?>