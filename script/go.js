
// 取得現在時間
function nowtime(){
    var now=new Date().getFullYear() + "-" + (new Date().getMonth() + 1) + "-" + new Date().getDate() +
    " " + new Date().getHours() + ":" + new Date().getMinutes() + ":" + new Date().getSeconds();
    return now;
}

// 檢查帳號格式
function checkFormat(str){   
    if (str.match(/^[a-zA-Z][a-zA-Z0-9]{6,20}$/)) {
        return true;  
    } else {    
        return false;
    }
}

// 檢查密碼格式
function checkPasswordFormat(str){
    if (str.match(/^[a-zA-Z0-9]{4,20}$/)) {
        return true; 
    } else {    
        return false;
    }
}

// 跳出alert視窗訊息
function showMessage(){
    let message=$('#message').val();
    if(message!=0){
        alert(message);
    }
}

// 取得資料庫所有留言
function goSelectMessage(){

    $.ajax({
        type:'POST',
        url : '../cont/selectmessageall.php',
        data : {'get':'get'},
        success : function(messageList){
            printMessage(JSON.parse(messageList));
        }
    })
}

// 印出留言
function printMessage(messageObject){
    let messageArea = document.getElementById('messageArea');
    messageArea.innerHTML = '';
    for (let messageItem of messageObject['messageList']) {
        unhtmlspecialchars(messageItem.title);
        let row = '';
        row += `
        <tr>
            <td>${messageItem.account}</td>
            <td><a href='../cont/select_detail_message.php?messageId=${messageItem.messageId}'>${messageItem.title}</a></td>
            <td>${messageItem.thumb_count}</td>
            <td>${messageItem.created_at}</td>
            <td style="width:300px">
                <span class=pull-right>`;
        row += (messageObject['loginUserId'] == messageItem.userId) ? `
                    <a href='../cont/update.php?messageId=${messageItem.messageId}' class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>編輯</a>
                    <button class="btn btn-danger" onclick='deleteMessage(${messageItem.messageId})'><span class="glyphicon glyphicon-trash"></span>刪除</button>`: '';
        row += (!messageItem.is_thumb)?`
                    <button class="btn btn-info" onclick='giveThumb(${messageItem.messageId},${messageItem.userId})'><span class="glyphicon glyphicon-thumbs-up"></span>讚</button>`
                    :` <button class="btn btn-warning" onclick='removeThumb(${messageItem.messageId},${messageItem.userId})'>收<span class="glyphicon glyphicon-thumbs-down"></span></button>`;
        row +=`</span>
            </td>
        </tr>`;
        messageArea.innerHTML += row;
    }
}
// 刪除留言
function deleteMessage(messageId) {
    if(!confirm('確認刪除留言?')){
        return;
    }
    $.ajax({
        type: 'POST',
        url: '../cont/deletemessage.php',
        data: { messageId: messageId },
        success: function (s) {
            let remessage=JSON.parse(s);
            goSelectMessage();
            alert(remessage.message);
        },
        error: function () {
            alert('system error')
        }
    })
}

// 取得編輯留言資料
function selectEditMessage(){
    let url=String(window.location);
    let messageId=url.substring((url.indexOf('=')+1),url.length);
    let postData={'messageId':messageId};
    $.ajax({
        type:'post',
        url:'../cont/select_edit_message.php',
        data:postData,
        success:function(messageItem){
            printEditMessage(messageItem);
        },
    });
}


// 取得留言資料細節
function selectDetailMessage(){
    let url=String(window.location);
    let messageId=url.substring((url.indexOf('=')+1),url.length);
    let postData={'messageId':messageId};
    $.ajax({
        type:'post',
        url:'../cont/select_detail_message.php',
        data:postData,
        success:function(messageItem){
            messageItem=JSON.parse(messageItem)
            console.log(messageItem);
            printDetailMessage(messageItem);
        }
    });
}
    
// 送出編輯留言
function editMessage(){
    if(!confirm('確定修改嗎?')){
        return;
    }
    let url=String(window.location);
    let messageId=url.substring((url.indexOf('=')+1),url.length);
    let messageItem={
        'messageId':messageId,
        'title':$('#title').val(),
        'content':$('#content').val()
    }
    console.log(messageItem);
    $.ajax({
        type:'post',
        url:'../cont/edit_message.php',
        data:messageItem,
        success:function(){
            window.location='../cont/index.php';          
        }
    })
}

// 按讚
function giveThumb(messageId,userId){
    $.ajax({
        type:'post',
        url:'../cont/thumb.php',
        data:{
            'messageId':messageId,
            'userId':userId,
            'addOrRemove':'add'
        },
        success:function(e){
            console.log(e);
            goSelectMessage();
        }
    })
}

// 收讚
function removeThumb(messageId,userId){
    $.ajax({
        type:'post',
        url:'../cont/thumb.php',
        data:{
            'messageId':messageId,
            'userId':userId,
            'addOrRemove':'remove'
        },
        success:function(e){
            goSelectMessage();
        }
    })
}

// 檢查帳號格式與資料庫有無相同帳號 
function checkAccountFormat(e){
    if(checkFormat(e.target.value)){                
        // ajax 到後端檢查帳號是否存在
        $.ajax({
            type:'post',
            url:'../cont/getaccount.php',
            data:{account:e.target.value},
            // num_rows為查詢資料筆數
            success:function(num_rows){
                if(num_rows>0){
                    isAccountRight=false;
                    $('#account_Signal').html('已有相同帳號');       
                }else{
                    $('#account_Signal').html('ok');
                    isAccountRight=true;
                } 
            }
        })
    }else{
        $('#account_Signal').html('x');
        isAccountRight=false;
    }
}

// 檢查密碼格式
function checkPassword(e){
    if(checkPasswordFormat(e.target.value)){
        isPasswordRight=true;
        isPasswordTwice=false;
        $('#password_Signal').html('ok');
        $('#passwordTwice_Signal').html('密碼不相同');
    }else{
        isPasswordRight=false;
        isPasswordTwice=false;
        $('#passwordTwice_Signal').html('密碼不相同');
        $('#password_Signal').html('格式錯誤');
    }

}

// 二次驗證輸入密碼
function confirmPassword(e){
    let password='';
    password=$('#password').val();
    if(e.target.value==password){
        isPasswordTwice=true;
        $('#passwordTwice_Signal').html('ok');
    }else{
        isPasswordTwice=false;
        $('#passwordTwice_Signal').html('密碼不相同');
    }

}

// 將html字元轉譯回符號
function unhtmlspecialchars(ch) {
    if (ch===null) return '';
    ch = ch.replace("&quot;","\"");
    ch = ch.replace("&#039;","\'");
    ch = ch.replace("&lt;","<");
    ch = ch.replace("&gt;",">");
    ch = ch.replace("&amp;","&");
    return ch;
    }

// 送出註冊資料
