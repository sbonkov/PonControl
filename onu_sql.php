<?php
include 'ping.php';
include 'vars.php';
$extra = 'index.php';
include_once 'function_lib.php';
if ($table == NULL) {
$table = $_GET["olt"];
} else {
}
$sort = $_GET["sort"];
if ($sort == NULL) {
$sort = "name";
} else {
}
$sfp = $_GET["sfp"];
 if ($sfp == NULL) {
$sort_sfp == NULL;
}
else { 
$sort_sfp = "&sfp=$sfp";
}

if ($search == NULL)
{
} else {
$search_sql ="AND name LIKE \"%$search%\" OR mac LIKE \"%$search%\" OR comments LIKE \"%$search%\"";
}

$ip = str_replace ("_", ".", $table);

include 'get_ro.php';
$date = date('d.m.Y H:i:s');
$tables = $table."s";

$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
$conn->set_charset("utf8");
//mysql_select_db($mysql_db);

echo "<font size=\"3\"><table cellspacing=\"0\"><thead>";
echo "<tr><th style=\"width: 8px; padding: 0px;\"></th><th><a href=\"index.php?page=olt&olt=$ip&sort=name".$sort_sfp."\"></a></th><th><a href=\"index.php?page=olt&olt=$ip&sort=mac".$sort_sfp."\">ПОРТ/ONU MAC</a></th><th><a 
href=\"index.php?page=olt&olt=$ip&sort=comments".$sort_sfp."\">Описание</a></th><th><a href=\"index.php?page=olt&olt=$ip&sort=pwr".$sort_sfp."\">НИВА</a></th><th><a href=\"index.php?page=olt&olt=$ip&sort=last_activity".$sort_sfp."\">Последна активност</a></th><th>Премахни ONU от OLT </th><th>Изтрий ONU</th></tr></thead>";


if ($sort == "pwr") {
$sort="CAST(last_pwr AS DECIMAL(3,1)) DESC";
}

$ip_sql = sprintf('%u', ip2long($ip));


$sql = "select * from onus WHERE olt=\"$sql_ip\" AND name LIKE \"EPON0/$sfp%\" $search_sql ORDER BY $sort";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}
while ($row=$retval->fetch_array(MYSQLI_BOTH)) {

$nameint = $row['name'];
$mac = $row['mac'];

if ($use_userside == "yes") {
$code = $row['code'];
$type = $row['type'];
if ($code == NULL) {
$comments = $row['comments'];
} else {
include 'get_us_data.php';
include 'make_comments_by_us.php';
}
} else {
$comments = $row['comments'];
}

$pwr = $row['pwr'];
$last_pwr = $row['last_pwr'];
$last_act = $row['last_activity'];
$lat = $row['lat'];

if ($lat == NULL) {
$lat = 0;
} else {
}

$nameint = NameIntDelZero($nameint);

if ($pwr == "Offline" or $ping == 0) {
// Цвят при offline
$color="red";
$cell_color = "#FF0000";
} 
elseif ($pwr <= -26) {
//  $lable="Слаб сигнал!!!";
$cell_color = "#FFCA33";
$color="#000000";
}
elseif ($pwr >= -9) {
//  $lable="Силен сигнал!!!";
$cell_color = "#33FFE9";
$color="#000000";
}
else {
//Вси4ко е точно.
$cell_color = "#66FF11";
$color="#000000";
}

echo "<tr class=\"container\" onclick=\"document.location = '?page=onu&olt=$ip&mac=$mac';\">";
echo "<td style=\"background: $cell_color;\"></td>";
echo "<td class=\"container\" style=\"white-space:nowrap; width: 5px; margin: 0px; padding: 0px;\">";
if ($lat == 0) {
echo "<img width=\"16\" src=\"images/marker_red.png\" title=\"Не е отбелязано на картата\">";
}
else {
echo "<img width=\"16\" src=\"images/marker_green.png\" title=\"Отбелязано е на картата\">";
}
echo "</td><td><div align=\"left\"><font size=\"2\"><b>$nameint</b></font><br/>$mac</div></td><td class=\"abon_name\">$comments</td>";

if ($pwr == "Offline" or $ping == 0) {
echo "<td style=\"padding:0px;\"><font color=\"red\">$last_pwr</font></td><td style=\"padding:0px;\">$last_act</td>";
} else {
echo "<td style=\"padding:0px;\">";
echo $pwr;
echo "</td><td style=\"padding:0px;\"></td>";
}


$epon_sfp = end(explode('/', $nameint));
$epon_sfp = explode(':', $epon_sfp);
$epon_sfp = $epon_sfp[0];
// delete onu from olt
echo "<td><a href=\"index.php?page=unbind_onu&ip=$ip&mac=$mac&sfp=$epon_sfp\"  onclick=\"return confirm('Изтриване на ONU от OLT? ONU-то може да остане в списъка докато не бъде инсталирано повторно. Тази опция отнема няколко минути!!! ')\">X</a></td>";
//delete onu from database
echo "<td><a href=\"index.php?page=delete_onu&ip=$ip&mac=$mac&sfp=$epon_sfp\"  onclick=\"return confirm('Изтриване на ONU от Базата Данни? Моля преди да го изтриете от базата премахнете го от -- Премахни ONU от OLT -- ')\">X</a></td></tr>";
}
?>
</table>
