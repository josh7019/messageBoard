function replyShowOrHide(){
    if($('#reply').css('display')=='block'){
        $('#reply').css('display','none');
        $('#hide_or_show').html('展開回覆');
    }else{
        $('#reply').css('display','block');
        $('#hide_or_show').html('收起回覆');
    }

}