<?php

$today_mk = getmk();
//建立log檔案內容
$log_txt = "收到系統通知時間 : ".date("Y-m-d H:i:s" , $today_mk)." \n";
$log_txt .= "======================================== \n";
$log_txt .= "收到 POST 變數如下 : \n";
foreach($_POST as $key => $val){ $log_txt .= "=> {$key} : {$val} \n"; }
$log_txt .= "======================================== \n\n\n";
$log_txt .= "收到 GET 變數如下 : \n";
foreach($_GET as $key => $val){ $log_txt .= "=> {$key} : {$val} \n"; }
$log_txt .= "======================================== \n\n\n";
$log_txt .= "收到 SERVER 變數如下 : \n";
foreach($_SERVER as $key => $val){ $log_txt .= "=> {$key} : {$val} \n"; }
$log_txt .= "======================================== \n\n\n";
$log_txt .= "收到 COOKIE 變數如下 : \n";
foreach($_COOKIE as $key => $val){ $log_txt .= "=> {$key} : {$val} \n"; }
$log_txt .= "======================================== \n\n\n";
$log_txt .= "收到 SESSION 變數如下 : \n";
foreach($_SESSION as $key => $val){ $log_txt .= "=> {$key} : {$val} \n"; }
$log_txt .= "======================================== \n\n\n";
//$log_txt .= "收到 GLOBALS 變數如下 : \n";
//foreach($GLOBALS as $key => $val){ $log_txt .= "=> {$key} : {$val} \n"; }
//$log_txt .= "======================================== \n\n\n";

//建立log檔案
$logname = basename($_SERVER['PHP_SELF'] , ".php");
$fp = fopen("./log/{$logname}_".date("Ymd_His" , $today_mk).".txt" , "w");
fwrite($fp , $log_txt);
fclose($fp);




?>