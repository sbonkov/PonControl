<?php
$mysql_host = "localhost";
$mysql_db = "poncontrol";
$mysql_user = "ponuser";
$mysql_pass = "pswd";



$telnet_user = "user";
$telnet_pass = "pwd";
//При использовании пароля Enable раскомментируйте следующую строчку и укажите используемый пароль
$enable_pass = "";


$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$use_userside = "no";
date_default_timezone_set('Europe/Kiev');
$date = date('Y.m.d H:i:s'); //get current date
$default_lat = "47.7651400";
$default_lon = "27.9293200";
$left_href2="http://google.com";
$left_href_txt2="Google";
$left_href3="?page=splitters";
$left_href_txt3="Splitters";
$left_href="http://local.com.ua";
$left_href_txt="Local";
?>
