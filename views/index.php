<?php require_once('../api.php'); ?>
<!DOCTYPE html>
<html lang="en">
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
            <li class="a"><a href="#">登出 <span class="sr-only"></span></a></li>
            <li><a href="#">註冊?</a></li>
        </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>


    <div class='container'>
        <div id="nowTime"></div>
        <div>
            <!-- 待辦新增表格 -->
            <div id='addTodoList'>
                <form class="form-horizontal">
                        <fieldset>
                        
                        <!-- Form Name -->
                        <legend>留言板</legend>
                        
                        <!-- Text input-->
                        <!-- <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">待辦日期</label>  
                          <div class="col-md-4">
                          <input id="textinput" name="textinput" type="date" placeholder="" class="form-control input-md">
                            
                          </div>
                        </div> -->
                        
                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">標題</label>  
                          <div class="col-md-4">
                          <input id="textinput" name="textinput" type="text" placeholder="" class="form-control input-md">
                            
                          </div>
                        </div>
                        
                        <!-- Textarea -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textarea">內容</label>
                          <div class="col-md-4">                     
                            <textarea  class="form-control" id="textarea" name="textarea"></textarea>
                          </div>
                        </div>
                        
                        <!-- Button -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for=""></label>
                          <div class="col-md-4">
                            <button type="button" class="btn btn-primary">Add</button>
                          </div>
                        </div>
                        
                        </fieldset>
                        </form>
                <!-- <h1>{{todoWhat}}</h1><br>
                <h1>{{todoContent}}</h1> -->
            </div><!-- 待辦新增表格結束 -->
            

            <!-- 待辦清單顯示區 -->
                <table class="table table-striped" id='showTodoList'>
                    <thead>
                        <tr>
                            <th>留言人</th>
                            <th>標題</th>
                            <th>讚</th>
                            <th>留言時間</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php showMessage() ?>
                        <tr >
                        <!-- style='border:solid' -->
                            <td >not yet</td>
                            <td ><a href="#">not yet</a> </td>
                            <td >not yet</td>
                            <th >not yet</th>
                            <td style='width:300px'>
                            <span class=pull-right>
                            <button class="btn btn-info">
                                <span class='glyphicon glyphicon-thumbs-up'></span>讚
                                </button> | 
                            <button class="btn btn-success">
                                <span class='glyphicon glyphicon-pencil'></span>編輯
                                </button> | 
                                <button class="btn btn-danger">
                                <span class='glyphicon glyphicon-trash'></span>刪除
                                </button>
                            </span>
                            </td>               
                        </tr>
                    </tbody>
                </table><!-- 待辦清單顯示區結束 -->            
        </div>
    </div>
    <script>
        setInterval(function(){
            document.getElementById('nowTime').innerHTML=nowtime();
        },1000)
        
        
    </script>
</body>
</html>