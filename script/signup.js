let isAccountRight = true;
let isPasswordRight = false;
let isPasswordTwice = false;
let account_input = document.getElementById('account');
let password_input = document.getElementById('password');
let passwordTwice_input = document.getElementById('passwordTwice');
let signup_form = document.getElementById('signup_form');

passwordTwice_input.oninput = function(event){confirmPassword(event)}
account_input.oninput = function(event){checkAccountFormat(event)};
password_input.oninput = function(event){checkPassword(event)};
signup_form.onsubmit = function(){return isSubmit();};

        
        //格式驗證正確後submit才能激活
        function isSubmit(){
            return (isAccountRight && isPasswordRight && isPasswordTwice) ? true : false;  
        }
        
        //若有訊息則跳出訊息視窗
        window.onload = function(){
            showMessage();
        }  