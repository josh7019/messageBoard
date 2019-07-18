<?php 
    @session_start();
    
    function printMessage(){
            
        echo '<tr>';
        echo '<td >not yet</td>';
        echo '<td ><a href="">not yet</a> </td>';
        echo '<td >not yet</td>';
        echo '<td >not yet</td>';
        echo '<td style="width:300px"><span class=pull-right><button class="btn btn-info"><span class="glyphicon glyphicon-thumbs-up"></span>讚</button> | <button class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>編輯</button> | <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>刪除</button></span></td>';
        echo '</tr>';

    }

    function clearmessage(){
        unset($_SESSION['message']);
    }

    function printLink(){
        if(isset($_SESSION['userId'])&&isset($_SESSION['account'])){
            echo '<a href="../cont/signout.php">登出 <span class="sr-only"></span></a></li>';            
        }else{
            echo '<a href="../views/login.php">登入 <span class="sr-only"></span></a></li><li><a href="signup.php">註冊?</a></li>';
        }
    }

    function replaceChar($text){
        // $text=str_replace('&',"&amp;",$text);
        // $pattern='/"/i';
        $text=preg_replace("/&/","&apos;",$text);
        $text=preg_replace("/'/","&apos;",$text);
        $text=preg_replace('/"/',"&quot;",$text);
        $text=preg_replace('/</',"&lt;",$text);
        $text=preg_replace('/>/',"&gt;",$text);
        $text=preg_replace('/ /',"&nbsp;",$text);
        return $text;
    }
?>