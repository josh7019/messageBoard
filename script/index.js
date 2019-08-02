let isTitleRight = false;
let isContentRight = false;
let add_message_form = document.getElementById('add_message_form');
let content = document.getElementById('content');
let title = document.getElementById('title');

content.oninput = function(event){
    isContentRight = checkContent(event);
}
title.oninput = function(event){
    isTitleRight = checkContent(event);
}
add_message_form.onsubmit = function(){
    if(!isTitleRight){
        alert('標題不得為空');
    }
    if(!isContentRight){
        alert('內容不得為空');
    }
    return (isTitleRight && isContentRight) ? true : false;
}
// 時間跳動
document.getElementById('nowTime').innerHTML = nowtime();

setInterval(function()
{
    document.getElementById('nowTime').innerHTML = nowtime();
},1000)

// 跳頁時顯示訊息
window.onload = function()
{
    showMessage();
}
// 從資料庫取資料並顯示留言
goSelectMessage();

//檢查內容是否為空
function checkContent(e){   
    str = e.target.value;
    if (str.match(/\S{1,}/)) {
        return true;  
    } else {    
        return false;
    }
}