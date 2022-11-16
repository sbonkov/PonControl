<?php
$mysql_host = "localhost";
$mysql_db = "poncontrol";
$mysql_user = "dbuser";
$mysql_pass = "dbpassword";



$telnet_user = "olt-user";
$telnet_pass = "olt-password";
//При использовании пароля Enable раскомментируйте следующую строчку и укажите используемый пароль
//$enable_pass = "enablepassword";


$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$use_userside = "no";
date_default_timezone_set('Europe/Sofia');
$date = date('Y.m.d H:i:s'); //get current date
$default_lat = "43.847502";
$default_lon = "25.961346";
$left_href2="?page=help";
$left_href_txt2="Помощ";
$left_href3="?page=splitters";
$left_href_txt3="Сплитери";
$left_href="https://www.latlong.net/";
$left_href_txt="Координати";
?>
