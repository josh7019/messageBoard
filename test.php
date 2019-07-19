<?php
    // require_once('command.php');
    // $password=password_hash(0000,PASSWORD_DEFAULT);
    // echo $password;
    // $password2=0000;
    // $password3='0000';
    // echo "<br>".password_verify($password2,$password);
    // echo "<br>".password_verify($password3,$password);
    // replaceChar(123);
    
    // function select_all($table,$select_list){
    //     $select_string='';
    //     foreach($select_list as $select_single){
    //         $select_string.=$select_single.',';
    //     }
    //     $select_string=substr($select_string,0,strlen($select_string)-1);
    //     $sql="select {$select_string} from {$table}";

    //     echo $sql;
    // }
    // echo select_all('s',['userId','userName']);

     
     
    
        // function select_all($table,$select_list){
        //     $server="localhost";
        //     $user='root';
        //     $password='';
        //     $db_name='messageboard2';
        //     $mysqli;
        //     date_default_timezone_set('Asia/Taipei');
        //     $mysqli=new mysqli($server,$user,$password,$db_name);
        //     $mysqli->set_charset('utf-8');
        //     $select_string='';
        //     foreach($select_list as $select_single){
        //         $select_string.=$select_single.',';
        //     }
        //     $select_string=substr($select_string,0,strlen($select_string)-1);
        //     $sql="select {$select_string} from {$table}";
        //     $pre=$mysqli->prepare($sql);
        //     $pre->execute();
        //     $pre->store_result();
        //     echo $pre->num_rows;
        // }


    class Model {
        private $server="localhost";
        private $user='root';
        private $password='';
        private $db_name='messageboard2';
        private $mysqli;
        public function __construct(){
            date_default_timezone_set('Asia/Taipei');
            $this->mysqli=new mysqli($this->server,$this->user,$this->password,$this->db_name);
            $this->mysqli->set_charset('utf8');
            // var_dump($this->mysqli);
        }
        
        
        ###############################  SELECT TEST AREA   ############################
        public function select_all($table,$select_list){
            $select_string='';
            foreach($select_list as $select_single){
                $select_string.=$select_single.',';
            }
            $select_string=substr($select_string,0,strlen($select_string)-1);
            $sql="select {$select_string} from {$table}";
            // echo $sql;
            // var_dump($this->mysqli);
            $pre=$this->mysqli->prepare($sql);
            $pre->execute();
            // $pre->store_result();
            // echo $pre->num_rows;
            // if($pre->num_rows>0){
                $result=$pre->get_result();
                // var_dump($result);
                $resultList=[];
                $resultItem=[];
                while($row=$result->fetch_assoc()){
                    
                    foreach($row as $key=>$value){
                        // $$key=$value;
                        // echo '<br>'.$$key;
                        $resultItem[$key]=$value;
                        // echo "<br>".$key.":".$resultItem[$key];
                    }
                    $resultList[]=$resultItem;
                }
                // var_dump($resultList);
            return $resultList;
        }
        // echo select_all('user',['*']);
    
        ###############################  SELECT TEST AREA END  ############################


        ###############################  INSERT TEST AREA   ############################
        
        public function insert_into($table,$insert_colum_list,$insert_value_list,$type_string){
            
            $insert_colum_string='';
            $insert_value_string='';
            
            foreach($insert_colum_list as $insert_colum){
                $insert_colum_string.=$insert_colum.',';
            }
            $insert_colum_string=substr($insert_colum_string,0,strlen($insert_colum_string)-1);
            
            foreach($insert_value_list as $insert_value){
                $insert_value_string.='?,';
            }

            $insert_value_string=substr($insert_value_string,0,strlen($insert_value_string)-1);

            $sql="insert into {$table} ({$insert_colum_string}) values ({$insert_value_string})";
            $pre=$this->mysqli->prepare($sql);
            $pre->bind_param($type_string,...$insert_value_list);
            $pre->execute();
            return $pre->affected_rows;
        }
        ###############################  INSERT TEST AREA END  ############################
    }

    function delete($table,$where_colum_list,$where_value_list){
        $where_colum_string='';
        $where_value_string='';
        
    }
    
    //  $a=new Model();
     echo $a->insert_into('message',['userId','title','content'],[19,"test","test"],'iss');
    echo json_encode($a->select_all('user',['*'])); 
?>