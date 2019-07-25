
//取得現在時間
    function nowtime(){
        var now=new Date().getFullYear() + "-" + (new Date().getMonth() + 1) + "-" + new Date().getDate() +
        " " + new Date().getHours() + ":" + new Date().getMinutes() + ":" + new Date().getSeconds();
        return now;
    }

// 檢查帳號格式
    function checkFormat(str){   
        if(str.match(/^[a-zA-Z][a-zA-Z0-9]{6,20}$/)){
            // alert('true');
            return true;  
        }else{    
            // alert('false');
            return false;
        }
    }

// 檢查密碼格式
    function checkPasswordFormat(str){
        if(str.match(/^[a-zA-Z0-9]{4,20}$/)){
            // alert('true');
            return true; 
        }else{    
            // alert('false');
            return false;
        }
    }

    //跳出alert視窗訊息
    function showMessage(){
        let message=$('#message').val();
        if(message!=0){
            alert(message);
        }
    }

//取得資料庫所有留言
    function goSelectMessage(){

        $.ajax({
            type:'POST',
            url:'../cont/selectmessageall.php',
            data:{'get':'get'},
            // dataType:'json',
            success:function(messageList){
                // console.log(messageList);
                console.log(JSON.parse(messageList));
                // alert('ajax ok');
                printMessage(JSON.parse(messageList));
            }
        })
        // alert('ok');
    }

//印出留言
    function printMessage(messageObject){
        let messageArea = document.getElementById('messageArea');
        messageArea.innerHTML = '';
        // console.log(messageObject['messageList'])
        // console.log(messageObject)
        for (let messageItem of messageObject['messageList']) {
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
//刪除留言
    function deleteMessage(messageId) {
        if(!confirm('確認刪除留言?')){
            return;
        }
        $.ajax({
            type: 'POST',
            url: '../cont/deletemessage.php',
            data: { messageId: messageId },
            success: function (s) {
                // console.log(JSON.parse(s));
                let remessage=JSON.parse(s);
                goSelectMessage();
                alert(remessage.message);
            },
            error: function () {
                alert('system error')
            }
        })
    }

    //取得編輯留言資料
    function selectEditMessage(){
        let url=String(window.location);
        let messageId=url.substring((url.indexOf('=')+1),url.length);
        // alert(messageId);
        let postData={'messageId':messageId};
        // console.log(postData)
        $.ajax({
            type:'post',
            url:'../cont/select_edit_message.php',
            data:postData,
            success:function(messageItem){
                // console.log(messageItem);
                printEditMessage(messageItem);
            },
        });
    }


    //取得留言資料細節
    function selectDetailMessage(){
        let url=String(window.location);
        let messageId=url.substring((url.indexOf('=')+1),url.length);
        // alert(messageId);
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
                // window.location='../cont/index.php';
                
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
                console.log(e);
                goSelectMessage();
                // window.location='../cont/index.php';
            }
        })
    }
