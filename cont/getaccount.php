<?php     
    // 檢查是否有相同帳號
    
    require_once('../mysql/all.php');
        
        if(isset($_POST['account'])){
            $account = $_POST['account'];
            $user_model = new User;
            $user_item = $user_model->getOneByAccount($account);
            
            $num_rows = (count($user_item)>0)?1:0;
            echo $num_rows;
        }else{
            echo $num_rows;
        }

?>