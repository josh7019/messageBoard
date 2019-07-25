// 時間跳動
document.getElementById('nowTime').innerHTML=nowtime();

setInterval(function()
{
    document.getElementById('nowTime').innerHTML=nowtime();
},1000)

// 跳頁時顯示訊息
window.onload=function()
{
    showMessage();
}
// 從資料庫取資料並顯示留言
goSelectMessage();