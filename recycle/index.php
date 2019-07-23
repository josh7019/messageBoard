<?php require_once('../command.php');?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src='../go.js'></script>
    <title>Document</title>
</head>
<body>
    <!-- 導覽列 -->
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href='index.php'>留言板</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <!-- <li class="a"><a href="../cont/signout.php">登出 <span class="sr-only"></span></a></li>
            <li><a href="signup.php">註冊?</a></li> -->
            <li class="a"><?php printLink();?></li>
        </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>


    <div class='container'>
        <div id="nowTime"></div>
        <div>
            <!-- 留言新增表格 -->
            <div id='addTodoList'>
                <form class="form-horizontal" method='POST' action='../cont/addmessage.php'>
                        <fieldset>
                        
                        <!-- Form Name -->
                        <legend>留言板</legend>
                        
                        <!-- 標題-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">標題</label>  
                          <div class="col-md-4">
                          <input id="textinput" name="title" type="text" placeholder="" class="form-control input-md">
                            
                          </div>
                        </div>
                        
                        <!-- 內容 -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textarea">內容</label>
                          <div class="col-md-4">                     
                            <textarea  class="form-control" id="textarea" name="content"></textarea>
                          </div>
                        </div>
                        
                        <!-- 按鈕 -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for=""></label>
                          <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Add</button>
                          </div>
                        </div>
                        
                        </fieldset>
                        </form>
                
            </div><!-- 留言新增表格結束 -->
            

            <!-- 留言顯示區 -->
                <table class="table table-striped" id='showTodoList'>
                    <thead>
                        <tr>
                            <th>留言人</th>
                            <th>標題</th>
                            <th>讚</th>
                            <th>留言時間</th>
                        </tr>
                    </thead>
                    <tbody id='messageArea'>
                        <!-- <tr >
                            <td >not yet</td>
                            <td ><a href="#">not yet</a> </td>
                            <td >not yet</td>
                            <th >not yet</th>
                            <td style='width:300px'>
                            <span class=pull-right>
                            
                            <button class="btn btn-success">
                                <span class='glyphicon glyphicon-pencil'></span>編輯
                            </button> | 
                            <button class="btn btn-danger">
                                <span class='glyphicon glyphicon-trash'></span>刪除
                            </button>
                            <button class="btn btn-info">
                                <span class='glyphicon glyphicon-thumbs-up'></span>讚
                            </button> | 
                            </span>
                            </td>               
                        </tr> -->
                    </tbody>
                </table><!-- 留言顯示區結束 -->            
        </div>
    </div>
    <input type="hidden" id='message' value='<?php echo (isset($_SESSION['message']))?$_SESSION['message']:''; ?>'>
    
    <!-- ------------------------------------------javascript------------------------------------------------------------ -->
    <!-- ------------------------------------------javascript------------------------------------------------------------ -->
    <!-- ------------------------------------------javascript------------------------------------------------------------ -->
    
    <script>
        //時間跳動
        document.getElementById('nowTime').innerHTML=nowtime();
        setInterval(function(){
            document.getElementById('nowTime').innerHTML=nowtime();
        },1000)
        
        //跳頁時顯示訊息
        window.onload=function(){
            showMessage();
        }
        //從資料庫取資料並顯示留言
        goSelectMessage();
    </script>
    <!-- 清除message -->
    <?php clearmessage();?>


</body>
</html>