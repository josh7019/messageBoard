
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" 
    integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src='../script/go.js'></script>
    <title>Document</title>
    <style>
        .myform{
            margin-top:30%;border:solid 1px;width:50%;margin-left:25%;text-align:center;border-radius: 20px;
        }
    </style>
</head>
<body>
    <!-- 導覽列 -->
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href='../cont/index.php'>留言板</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            {{if $is_login}}
                <li class="a"><a href="../cont/signout.php">登出 <span class="sr-only"></span></a></li>
            {{else}}
                <li class="a"><a href="login_smarty.php">登入 <span class="sr-only"></span></a></li>
                <li><a href="../cont/signup_smarty.php">註冊?</a></li> 
            {{/if}}
        </ul>
        </div>
    </div>
    </nav>
    <!-- 導覽列結束 -->

    
    <div class='container'>
        
        <form class="form-horizontal myform" method='POST' action="../cont/login.php" onsubmit="return isSubmit();">
        <fieldset>

        <!-- Form Name -->
        <legend >登入</legend>

        <!-- Text input-->
        <div class="form-group">
        <label class="col-md-4 control-label" for="Account">帳號</label>  
        <div class="col-md-4">
        <input id="account" oninput="checkAccountFormat(event)" name="account" type="text" placeholder="請輸入帳號" class="form-control input-md" required="">
            
        </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
        <label class="col-md-4 control-label" for="password">密碼</label>  
        <div class="col-md-4">
        <input id="password" oninput="checkPassword(event)" name="password" type="password" placeholder="請輸入密碼" class="form-control input-md" required="">
            
        </div>
        </div>

        <!-- Button -->
        <div class="form-group">
                <label class="col-md-4 control-label" for="signin"></label>
                <div class="col-md-4">
                  <button id="signin" name="signin" class="btn btn-info">登入</button>
                  <a href="../cont/signup_smarty.php" class='btn btn-success'>註冊</a>
                </div>
              </div>

        </fieldset>
        </form>
    </div>
    <input type="hidden" id='message' value='{{$message}}'>
    
    
    <script type="text/javascript" src='../script/login.js'></script>
    <script>
        
    </script>
    <!-- 清除message -->

</body>
</html>