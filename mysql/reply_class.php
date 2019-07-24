<?php

    class Reply extends Model
    {
        private $table = 'reply';

        public function addOne($messageId,$userId,$content)
        {
            $is_success=$this->insertInto($this->table,['messageId','userId','content'],[$messageId,$userId,$content],'iis');
            return $is_success;
        }

        public function getCount($messageId)
        {
            $reply_count=$this->selectSingle($this->table,['count(*)'],['messageId'],[$messageId],'i');
            return $reply_count['count(*)'];
        }

        public function getReplysByMessageId($messageId)
        {
            $message_reply_list=$this->selectAllWithWhere($this->table,['*'],['messageId'],[$messageId],'i');
            return $message_reply_list;
        }
    }

?>