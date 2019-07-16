<?php 
    session_start();
    
    function showMessage(){
            
        echo '<tr>';
        echo '<td >not yet</td>';
        echo '<td ><a href="">not yet</a> </td>';
        echo '<td >not yet</td>';
        echo '<td >not yet</td>';
        echo '<td style="width:300px"><span class=pull-right><button class="btn btn-info"><span class="glyphicon glyphicon-thumbs-up"></span>讚</button> | <button class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>編輯</button> | <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>刪除</button></span></td>';
        echo '</tr>';

    }

?>