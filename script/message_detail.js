let replyShow=document.getElementById('replyShowOrHide');
replyShow.onclick=function(){
    replyShowOrHide();
}

function replyShowOrHide(){
    if($('#reply').css('display')=='block'){
        $('#reply').css('display','none');
        $('#hide_or_show').html('展開回覆');
    }else{
        $('#reply').css('display','block');
        $('#hide_or_show').html('收起回覆');
    }

}

window.onload = function (){
    showMessage();
}  