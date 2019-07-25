<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src='../script/go.js'></script>
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
        <a class="navbar-brand" href='../cont/index.php'>留言板</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            {{if $is_login}}
                <li class="a"><a href="../cont/signout.php">登出 <span class="sr-only"></span></a></li>
            {{else}}
                <li class="a"><a href="login.php">登入 <span class="sr-only"></span></a></li>
                <li><a href="../cont/signup_smarty.php">註冊?</a></li> 
            {{/if}}
        </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>


    <div class='container'>
        <div id="nowTime"></div>
        <div>
            <!-- 留言新增表格 -->
            <div id='addTodoList'>
                <form class="form-horizontal" id='editMessage'>
                        <fieldset>
                        
                        <!-- Form Name -->
                        <legend>編輯留言</legend>
                        
                        <!-- 標題-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">標題</label>  
                          <div class="col-md-4">
                          <input id="title" name="title" type="text" placeholder="上限30個字" class="form-control input-md">
                            
                          </div>
                        </div>
                        
                        <!-- 內容 -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textarea">內容</label>
                          <div class="col-md-4">                     
                            <textarea class="form-control" id="content" name="content"></textarea>
                          </div>
                        </div>
                        
                        <!-- 按鈕 -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for=""></label>
                          <div class="col-md-4">
                            <button type="button" onclick="editMessage()" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>修改</button>
                            <a href='index.php' class="btn btn-info">取消</a>
                          </div>
                        </div>
                        

                        </fieldset>
                        </form>
                
            </div><!-- 留言新增表格結束 -->
                   
        </div>
    </div>
    <input type="hidden" id='message' value='{{$message}}'>
    
    
    <script type="text/javascript" src='../script/update.js'></script>
</body>
</html>