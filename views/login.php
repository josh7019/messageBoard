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
                  <a href="../views/signup.html" class='btn btn-success'>註冊</a>
                </div>
              </div>

        </fieldset>
        </form>
    </div>
    <input type="hidden" id='message' value='<?php echo (isset($_SESSION['message']))?$_SESSION['message']:''; ?>'>
    <script>
        let isAccountRight=true;
        let isPasswordRight=false;
        
        function checkAccountFormat(e){
            isAccountRight=(checkFormat(e.target.value))?true:false;
        }
        function checkPassword(e){
            isPasswordRight=(checkPasswordFormat(e.target.value))?true:false;    
        }
        //格式驗證正確後submit才能激活
        function isSubmit(){
            if(isAccountRight&&isPasswordRight){
                return true;
            }else if(isAccountRight==false){
                alert('帳號格式錯誤');
                return false;
            }else {
                alert('密碼格式錯誤');
                return false;
            }
        }
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