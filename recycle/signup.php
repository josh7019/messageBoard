<?php require_once('../command.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" 
    integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src='../go.js'></script>
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
        <form class="form-horizontal myform" method='POST' action='../cont/signup.php' onsubmit="return isSubmit();">
        <fieldset>

        <!-- Form Name -->
        <legend>註冊</legend>

        <!-- 帳號輸入 -->
        <div class="form-group">
        <label class="col-md-4 control-label" for="Account">帳號</label><span id='account_Signal'></span>
        <div class="col-md-4">
        <input id="account" oninput="checkAccountFormat(event)" name="account" type="text" placeholder="請輸入帳號" class="form-control input-md" required="">    
        <span class="help-block">至少7位,開頭為英文,不得有符號</span> 
        </div>
        </div>

        <!-- 密碼輸入-->
        <div class="form-group">
        <label class="col-md-4 control-label" for="password">密碼</label><span id='password_Signal'></span>  
        <div class="col-md-4">
        <input id="password" oninput="checkPassword(event)" name="password" type="password" placeholder="請輸入密碼" class="form-control input-md" required="">
        <span class="help-block">至少4位,不得有符號</span> 
        </div>
        </div>

        <!-- 二次密碼輸入-->
        <div class="form-group">
        <label class="col-md-4 control-label" for="password">驗證密碼</label><span id='passwordTwice_Signal'></span>
        <div class="col-md-4">
        <input id="passwordTwice" oninput='confirmPassword(event)' name="passwordTwice" type="password" placeholder="請再次輸入密碼" class="form-control input-md" required="">
            
        </div>
        </div>

        <!-- 送出按鈕 -->
        <div class="form-group">
        <label class="col-md-4 control-label" for="login"></label>
        <div class="col-md-4">
            <button id="login" name="signup" class="btn btn-success">註冊</button>
        </div>
        </div>

        </fieldset>
        </form>
    </div>
    <input type="hidden" id='message' value='<?php echo (isset($_SESSION['message']))?$_SESSION['message']:''; ?>'>
    <script>
        let isAccountRight=true;
        let isPasswordRight=false;
        let isPasswordTwice=false;
        
        //檢查帳號格式與資料庫有無相同帳號 
        function checkAccountFormat(e){
            if(checkFormat(e.target.value)){                
                // ajax 到後端檢查帳號是否存在
                $.ajax({
                    type:'post',
                    url:'../cont/getaccount.php',
                    data:{account:e.target.value},
                    //num_rows為查詢資料筆數
                    success:function(num_rows){
                        if(num_rows>0){
                            // alert(num_rows)
                            isAccountRight=false;
                            // alert(isAccountRight);
                            $('#account_Signal').html('已有相同帳號');       
                        }else{
                            $('#account_Signal').html('ok');
                            isAccountRight=true;
                        } 
                        // console.log(num_rows)
                    }
                })
            }else{
                $('#account_Signal').html('x');
                isAccountRight=false;
            }
        }
        
        //檢查密碼格式
        function checkPassword(e){
            if(checkPasswordFormat(e.target.value)){
                isPasswordRight=true;
                $('#password_Signal').html('ok');
            }else{
                isPasswordRight=false;
                $('#password_Signal').html('格式錯誤');
            }

        }
        
        //二次驗證輸入密碼
        function confirmPassword(e){
            let password='';
            password=$('#password').val();
            if(e.target.value==password){
                isPasswordTwice=true;
                $('#passwordTwice_Signal').html('ok');
            }else{
                isPasswordTwice=false;
                $('#passwordTwice_Signal').html('密碼不相同');
            }
            
        }
        
        //格式驗證正確後submit才能激活
        function isSubmit(){
            return (isAccountRight&&isPasswordRight&&isPasswordTwice)?true:false;  
        }
        
        //若有訊息則跳出訊息視窗
        window.onload=function(){
            // let message=$('#message').val();
            // if(message!=''){
            // alert(message);
            // }
            showMessage();
        }  
    </script>
    <!-- 清除message -->
    <?php clearmessage();?>
</body>
</html>