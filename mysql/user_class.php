<?php
    include_once('model.php');

    class User extends Model{
        private $table='User';
        
        ##取得單一使用者資料
        public function get_one($userId){
            $user=$this->select_single('user',['*'],['userId'],[$userId],'i');
            return $user;
        }

        ##取得所有使用者資料
        public function get_all(){
            $userList=$this->select_all($this->table,['*']);
            return $userList;
        }

    }






?>