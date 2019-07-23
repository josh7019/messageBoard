<?php
    @session_start();

    class Model 
    {
        private $server="localhost";
        private $user='root';
        private $password='';
        private $db_name='messageboard2';
        private $mysqli;
        
        public function __construct()
        {
            date_default_timezone_set('Asia/Taipei');
            $this->mysqli=new mysqli($this->server,$this->user,$this->password,$this->db_name);
            $this->mysqli->set_charset('utf8');
            // var_dump($this->mysqli);
        }
        
        
        ###############################  SELECT_ALL TEST AREA   ############################
        public function selectAll($table,$select_list){
            $select_string='';
            foreach($select_list as $select_single){
                $select_string.=$select_single.',';
            }
            $select_string=substr($select_string,0,strlen($select_string)-1);
            $sql="select {$select_string} from {$table}";
            $pre=$this->mysqli->prepare($sql);
            $pre->execute();
            $result=$pre->get_result();
            $resultList=[];
            $resultItem=[];
                while($row=$result->fetch_assoc()){
                    foreach($row as $key=>$value){
                        $resultItem[$key]=$value;
                    }
                    $resultList[]=$resultItem;
                }
            return $resultList;
        }
    
        ###############################  SELECT_ALL TEST AREA END  ############################


        ###############################  SELECT_SINGLE TEST AREA END  ############################
        
        public function selectSingle($table,$select_list,$where_colum_list,$where_value_list,$type_string)
        {
            $where_colum_string='';
            $where_value_string='';
            $select_string='';
            ##組成select字串
            foreach($select_list as $select_single){
                $select_string.=$select_single.',';
            }
            ##組成where字串
            foreach($where_colum_list as $where_colum){
                $where_colum_string.=$where_colum.',';
            }
            foreach($where_value_list as $where_value){
                $where_value_string.='?,';
            }
            ##去逗號
            $where_colum_string=substr($where_colum_string,0,strlen($where_colum_string)-1);
            $where_value_string=substr($where_value_string,0,strlen($where_value_string)-1);
            $select_string=substr($select_string,0,strlen($select_string)-1);
            #組成sql語法
            $sql="select $select_string from $table 
            where ({$where_colum_string}) = ($where_value_string)";
            $pre=$this->mysqli->prepare($sql);
            $pre->bind_param($type_string,...$where_value_list);
            $pre->execute();
            $result=$pre->get_result();
            $resultItem=[];
                while($row=$result->fetch_assoc()){
                    foreach($row as $key=>$value){
                        $resultItem[$key]=$value;
                    }
                }
            return $resultItem;
        }
        
        
        
        
        ###############################  INSERT TEST AREA   ############################
        
        public function insertInto($table,$insert_colum_list,$insert_value_list,$type_string)
        {  
            $insert_colum_string='';
            $insert_value_string='';
            ##組成insert字串
                foreach($insert_colum_list as $insert_colum){
                    $insert_colum_string.=$insert_colum.',';
                }
                $insert_colum_string=substr($insert_colum_string,0,strlen($insert_colum_string)-1);
                
                foreach($insert_value_list as $insert_value){
                    $insert_value_string.='?,';
                }
            ##去掉尾端逗號
            $insert_value_string=substr($insert_value_string,0,strlen($insert_value_string)-1);
            $sql="insert into {$table} ({$insert_colum_string}) values ({$insert_value_string})";
            $pre=$this->mysqli->prepare($sql);
            $pre->bind_param($type_string,...$insert_value_list);
            $pre->execute();
            return $pre->affected_rows;
        }
        ###############################  INSERT TEST AREA END  ############################
    
        
        
        ###############################  DELETE TEST AREA START  ############################
        
        
        public function delete($table,$where_colum_list,$where_value_list,$type_string)
        {
            $where_colum_string='';
            $where_value_string='';
            ##組成where字串
                foreach($where_colum_list as $where_colum){
                    $where_colum_string.=$where_colum.',';
                }
                foreach($where_value_list as $where_value){
                    $where_value_string.='?,';
                }
            ##去逗號
            $where_colum_string=substr($where_colum_string,0,strlen($where_colum_string)-1);
            $where_value_string=substr($where_value_string,0,strlen($where_value_string)-1);
            $sql="delete from $table where ($where_colum_string) = ($where_value_string)";
            $pre=$this->mysqli->prepare($sql);
            $pre->bind_param($type_string,...$where_value_list);
            $pre->execute();
            return $pre->affected_rows;
        }
        ###############################  DELETE TEST AREA END  ############################


        ###############################  UPDATE TEST AREA   ############################
    
        public function update($table,$set_colum_list,$set_value_list,$where_colum_list,$where_value_list,$type_string)
        {
            $set_colum_string='';
            $where_colum_string='';
            $where_value_string='';
            ##組成set字串
                foreach($set_colum_list as $set_colum){
                    $set_colum_string.=$set_colum.'=?,';
                }
            ##組成where字串
                foreach($where_colum_list as $where_colum){
                    $where_colum_string.=$where_colum.',';
                }
                foreach($where_value_list as $where_value){
                    $where_value_string.='?,';
                }
            ##去逗號
            $where_colum_string=substr($where_colum_string,0,strlen($where_colum_string)-1);
            $where_value_string=substr($where_value_string,0,strlen($where_value_string)-1);
            $set_colum_string=substr($set_colum_string,0,strlen($set_colum_string)-1);
            $sql="update $table set $set_colum_string where ($where_colum_string) = ($where_value_string)";
            $pre=$this->mysqli->prepare($sql);
            $pre->bind_param($type_string,...$set_value_list,...$where_value_list);
            $pre->execute();
            return $pre->affected_rows;
        }

        ###############################  UPDATE TEST AREA END  ############################
    }

?>