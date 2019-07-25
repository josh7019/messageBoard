let isAccountRight=true;
let isPasswordRight=false;
let isPasswordTwice=false;
let account_input=document.getElementById('account');
let password_input=document.getElementById('password');
let passwordTwice_input=document.getElementById('passwordTwice');
let signup_form=document.getElementById('signup_form');

passwordTwice_input.oninput=function(event){confirmPassword(event)}
account_input.oninput=function(event){checkAccountFormat(event)};
password_input.oninput=function(event){checkPassword(event)};
signup_form.onsubmit=function(){return isSubmit();};
// 檢查帳號格式與資料庫有無相同帳號 
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
                isPasswordTwice=false;
                $('#password_Signal').html('ok');
                $('#passwordTwice_Signal').html('密碼不相同');
            }else{
                isPasswordRight=false;
                isPasswordTwice=false;
                $('#passwordTwice_Signal').html('密碼不相同');
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
            showMessage();
        }  