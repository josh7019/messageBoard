<?php
// function getToken(){
//     $random_string='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $token_string='';
//     for($i=0;$i<250;$i++){
//         $token_string.=substr($random_string,rand(0,strlen($random_string)-1),1);

//     }
//     return $token_string;
// }

// echo getToken();
echo json_encode($_SERVER);