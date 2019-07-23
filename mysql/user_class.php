<?php
    include_once('model.php');

    class User extends Model
    {
        private $table='User';
        
        ##藉由userId取得單一使用者資料
        public function getOneByUserId($userId)
        {
            $user=$this->selectSingle('user',['*'],['userId'],[$userId],'i');
            return $user;
        }
        
        ##藉由account取得單依使用者資料
        public function getOneByAccount($account)
        {
            $user=$this->selectSingle('user',['*'],['account'],[$account],'s');
            return $user;
        }
        
        ##取得所有使用者資料
        public function getAll()
        {
            $userList=$this->selectAll($this->table,['*']);
            return $userList;
        }

        ##註冊新增
        public function signup($account,$password)
        {
            $is_success=$this->insertInto($this->table,['account','password'],[$account,$password],'ss');
            return $is_success;
        }

    }






?>