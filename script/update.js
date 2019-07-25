//時間跳動
document.getElementById('nowTime').innerHTML=nowtime();
setInterval(function(){
    document.getElementById('nowTime').innerHTML=nowtime();
},1000)

//跳頁時顯示訊息
window.onload=function(){
    showMessage();
}
selectEditMessage();

function printEditMessage(messageItem){
    messageItem=JSON.parse(messageItem);
        $('#title').val(messageItem.title);
        $('#content').val(messageItem.content);
}