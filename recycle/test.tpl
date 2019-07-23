
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src='../go.js'></script>
    <title></title>
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
				 <a  class="list-group-item list-group-item-action active" id='title'></a>
				<div class="list-group-item" style='background-color:GhostWhite' id='userName'>
					xx說:
				</div>
				<div class="list-group-item " style='height:200px;background-color:GhostWhite' >
					<h4 class="list-group-item-heading active" id='content'>
						內容
					</h4>
				</div>
				<div class="list-group-item justify-content-between" style='background-color:GhostWhite' id='timeAndThumb'>
					2017-08-25 08:08:08<span class="badge badge-secondary badge-pill">讚15</span>
				</div> 
                <a onclick='' class="list-group-item list-group-item-action justify-content-between">展開回覆<span class="badge badge-light badge-pill" id='replyCount'>14則</span></a>
			</div>
		</div>
	</div>
</div>
    
    <!-- ------------------------------------------javascript------------------------------------------------------------ -->
    <!-- ------------------------------------------javascript------------------------------------------------------------ -->
    <!-- ------------------------------------------javascript------------------------------------------------------------ -->
    <script>
        selectDetailMessage();

        function printDetailMessage(messageItem){
            $('#title').html(`標題:${messageItem.title}`);
            $('#userName').html(`${messageItem.account}說:`);
            $('#content').html(`${messageItem.content}`);
            $('#timeAndThumb').html(`${messageItem.updated_at}<span class="badge badge-secondary badge-pill">讚:${messageItem.thumb_count}</span>`);
        }
    </script>
</body>
</html>