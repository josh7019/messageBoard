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
        @session_start();

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
        
        
        ###############################  SELECT_ALL TEST AREA   ############################
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
    
        ###############################  SELECT_ALL TEST AREA END  ############################


        ###############################  SELECT_SINGLE TEST AREA END  ############################
        
        function select_single($table,$select_list,$where_colum_list,$where_value_list,$type_string){
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
        
        public function insert_into($table,$insert_colum_list,$insert_value_list,$type_string){
            
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
        
        
        public function delete($table,$where_colum_list,$where_value_list,$type_string){
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
            // echo $sql;
            $pre=$this->mysqli->prepare($sql);
            $pre->bind_param($type_string,...$where_value_list);
            $pre->execute();
            return $pre->affected_rows;
        }
        ###############################  DELETE TEST AREA END  ############################


        ###############################  UPDATE TEST AREA   ############################
    
        public function update($table,$set_colum_list,$set_value_list,$where_colum_list,$where_value_list,$type_string){
            $test="update table set a=?,b=? where id=?";
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
            // echo $sql;
            $pre=$this->mysqli->prepare($sql);
            $pre->bind_param($type_string,...$set_value_list,...$where_value_list);
            $pre->execute();
            return $pre->affected_rows;
        }

        ###############################  UPDATE TEST AREA END  ############################
    }

    

##--------------------------------------------------------------------------------------------------------

        class Message extends Model {
            private $table='message';        
            
            ##取得所有留言資料
            public function get_all(){
                $messageList=$this->select_all($this->table,['*']);
                return $messageList;
            }

            ##取得所有留言資料與細節
            public function get_all_detail(){
                $messageList=$this->get_all();
                foreach($messageList as $index => $messageItem){            
                    $user=new User;
                    $userItem=$user->get_one($messageItem['userId']);
                    $messageList[$index]['account']=$userItem['account'];
                    $thumb=new Thumb;
                    $thumb_count=$thumb->get_one_count($messageItem['userId']);
                    $messageList[$index]['thumb_count']=$thumb_count;
                }
                return $messageList;
            }

            ##取得單筆留言資料
            public function get_one($messageId){
                $messageItem=$this->select_single($this->table,['*'],['messageId'],[$messageId],'i');
                return $messageItem;
            }
            
            ##取得單筆留言資料與細節
            public function get_one_detail($messageId){
                $messageItem=$this->get_one($messageId);
                $user=new User;
                $userItem=$user->get_one($messageItem['userId']);
                $messageItem['account']=$userItem['account'];
                $thumb=new Thumb;
                $thumb_count=$thumb->get_one_count($messageItem['userId']);
                $messageItem['thumb_count']=$thumb_count;
                return $messageItem;
            }


        }


        class Thumb extends Model{
            private $table='thumb';
            
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




    
    //  $a=new Message;
    //   var_dump($a->get_all_detail()[0]);
    // var_dump($a->get_one_detail(22));

    //   $b=new thumb;
    //   var_dump($b->get_count(22));
    
    // $c=new thumb;
    // echo $c->remove_thumb(99,99);

    // $a->get_all();
    // echo json_encode($a->select_all('user',['*'])); 

    // $d=new User;
    // var_dump($d->get_all());
?>