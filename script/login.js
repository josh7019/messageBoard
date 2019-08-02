let isAccountRight = true;
let isPasswordRight = false;
let account_input = document.getElementById('account');
let password_input = document.getElementById('password');
let login_form = document.getElementById('login_form');

account_input.oninput = function(event){checkAccountFormat(event)};
password_input.oninput = function(event){checkPassword(event)};
login_form.onsubmit = function(){return isSubmit();};

function checkAccountFormat(e)
{
    isAccountRight = (checkFormat(e.target.value)) ? true : false;
}
function checkPassword(e)
{
    isPasswordRight = (checkPasswordFormat(e.target.value)) ? true : false;
}

// 格式驗證正確後submit才能激活
function isSubmit(){
    if(isAccountRight && isPasswordRight){
        return true;
    }else if(isAccountRight  ==  false){
        alert('帳號格式錯誤');
        return false;
    }else {
        alert('密碼格式錯誤');
        return false;
    }
}
window.onload = function(){
    showMessage();
}