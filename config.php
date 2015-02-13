<?php

$appid = "wxdc857181e6ca10c6";
$appsecret = "1659893297a7f0f85c09254c1d5fcc59";
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$jsoninfo = json_decode($output, true);
$access_token = $jsoninfo["access_token"];

$jsonmenu = '{
      "button":[
      {
           "name":"我的商通贷",
           "sub_button":[
            {
               "type":"click",
               "name":"绑定账号",
               "key":"binding"
            },
            {
               "type":"click",
               "name":"取消绑定",
               "key":"noBinding"
            },
            {
               "type":"click",
               "name":"查询审核进度",
               "key":"queryProgress"
            },
            {
               "type":"click",
               "name":"查询还款计划",
               "key":"queryPlan"
            }]
       },
       
       {
           "name":"商通贷",
           "sub_button":[
            {
               "type":"click",
               "name":"简介",
               "key":"introduction"
            }]
       }]
 }';


$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result = https_request($url, $jsonmenu);
var_dump($result);

function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}


?>