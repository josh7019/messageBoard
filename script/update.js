let edit = document.getElementById('editMessage_button');

edit.onclick = function(){
    editMessage();
}
// 時間跳動
document.getElementById('nowTime').innerHTML = nowtime();
setInterval(function(){
    document.getElementById('nowTime').innerHTML = nowtime();
},1000)

// 跳頁時顯示訊息
window.onload = function(){
    showMessage();
}
selectEditMessage();

function printEditMessage(messageItem){
    messageItem = JSON.parse(messageItem);
    messageItem.title = unhtmlspecialchars(messageItem.title);
    messageItem.content = unhtmlspecialchars(messageItem.content);
    $('#title').val(messageItem.title);
    $('#content').val(messageItem.content);
}