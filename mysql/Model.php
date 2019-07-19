<?php
    // date_default_timezone_set('Asia/Taipei');
    session_start();
    date_default_timezone_set('Asia/Taipei');
    // $mysqli=new mysqli("localhost",'root','','messageboard2');
    // $mysqli->set_charset('utf-8');
    
    class Model {
        private $server="localhost";
        private $user='root';
        private $password='';
        private $db_name='messageboard2';
        private $mysqli;
        public function __construct(){
            $this->mysqli=new mysqli($this->server,$this->user,$this->password,$this->db_name);
            $this->mysqli->set_charset('utf8');
            // var_dump($this->mysqli);
        }
        
        ##SELECT
        public function select_all($table,$select_list){
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

        public function insert_into($table,$insert_colum_list,$insert_value_list){

            
        }
    }

?>