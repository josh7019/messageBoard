function confirmPassword(){
    
    alert('ok');
}


function nowtime(){
    var now=new Date().getFullYear() + "-" + (new Date().getMonth() + 1) + "-" + new Date().getDate() +
     " " + new Date().getHours() + ":" + new Date().getMinutes() + ":" + new Date().getSeconds();
    return now;
}


function checkFormat(str){   
    if(str.match(/^[a-zA-Z][a-zA-Z0-9]{6,}$/)){
        // alert('true');
        return true;  
    }else{    
        // alert('false');
        return false;
    }
}

function checkPasswordFormat(str){
    if(str.match(/^[a-zA-Z0-9]{4,}$/)){
        // alert('true');
        return true; 
    }else{    
        // alert('false');
        return false;
    }
}




function showMessage(){
    let message=$('#message').val();
    if(message!=''){
        alert(message);
    }
}