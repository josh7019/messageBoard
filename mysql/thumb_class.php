<?php
    include_once('model.php');

    class Thumb extends Model{
        private $table='thumb';
        
        ##按讚
        public function add_one($messageId,$userId){
            $affected_rows=$this->insert_into($this->table,['messageId','userId'],[$messageId,$userId],'ii');
            return $affected_rows;
        }

        ##取得user是否按讚
        public function get_one($messageId,$userId){
            $thumb_Item=$this->select_single($this->table,['*'],['messageId','userId'],[$messageId,$userId],'ii');
            return $thumb_Item;
        }

        ##取得單筆留言讚數
        public function get_one_count($messageId){
            
            $thumb_Item=$this->select_single($this->table,['count(*)'],['messageId'],[$messageId],'i');
            return $thumb_Item['count(*)'];
        }
        
        ##移除讚
        public function remove_thumb($messageId,$userId){
            $is_success=$this->delete($this->table,['messageId','userId'],[$messageId,$userId],'ii');
            return $is_success;
        }
    }






?>