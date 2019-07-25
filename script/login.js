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
            showMessage();
        }