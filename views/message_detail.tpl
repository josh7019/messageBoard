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
                        <li class="a"><a href="../cont/login_smarty.php">登入 <span class="sr-only"></span></a></li>
                        <li><a href="../cont/signup_smarty.php">註冊?</a></li> 
                    {{/if}}
                    <li class="a"></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        </nav>
        
        
        <div class="container-fluid">
            <div class="row" style="margin-top:5%">
                <div class='col-md-4'></div>
                <div class="col-md-4">
                    <div class="list-group">
                        <a  class="list-group-item list-group-item-action active" id='title'>標題:{{$message_detail.title}}</a>
                        <div class="list-group-item" style='background-color:GhostWhite' id='userName'>
                            {{$message_detail.account}}說:
                        </div>
                        
                        <div class="list-group-item " style='height:200px;background-color:GhostWhite' style="border:solid;overflow:scroll;">
                            <textarea disabled class="list-group-item-heading active" id='content' style="height:100%;width:100%;;">{{$message_detail.content}}
                            </textarea>
                        </div>
                        
                        <div class="list-group-item justify-content-between" style='background-color:GhostWhite' id='timeAndThumb'>
                            {{$message_detail.updated_at}}<span class="badge badge-secondary badge-pill">讚:{{$message_detail.thumb_count}}</span>
                        </div>
                        
                        <div class="list-group-item justify-content-between" style='background-color:GhostWhite' id='timeAndThumb'>
                            <form action="../cont/add_reply.php" method='post'>
                                <input type='hidden' name='messageId' value="{{$messageId}}">
                                <textarea placeholder="" required name="content" style='width:80%;'></textarea> <button class="pull-right btn btn-info">回覆</button>
                            </form>
                            
                        </div> 
                            <a id='replyShowOrHide' class="list-group-item list-group-item-action justify-content-between">
                                <span id='hide_or_show'>展開回覆</span>
                                <span class="badge badge-light badge-pill" id='replyCount'>{{$reply_count}}則</span>
                            </a>
                        
                        <div style='display:none' id='reply'>
                            {{foreach $reply_list as $reply_item}}
                                <div class="list-group-item justify-content-between" style='background-color:GhostWhite' id='timeAndThumb'>
                                    {{$reply_item.content}}<span class="badge badge-secondary badge-pill">{{$reply_item.account}}</span>
                                </div>
                            {{/foreach}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id='message' value='{{$message}}'>
        <script type="text/javascript" src='../script/message_detail.js'></script>
    </body>
</html>