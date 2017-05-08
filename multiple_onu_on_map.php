<?php
include 'vars.php';
$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
mysql_query("SET NAMES utf8");
mysql_select_db($mysql_db);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$ip_sql = sprintf('%u', ip2long($ip));
$sql = "SELECT * FROM onus WHERE name LIKE \"EPON0/$sfp%\" AND olt=\"$ip_sql\"";
$res = mysql_query($sql) or die(mysql_error());

 while ($row=mysql_fetch_array($res)) {

$lon = $row['lon'];
$lat = $row['lat'];
$mac = $row['mac'];
$nameint = $row['name'];
$pwr = $row['pwr'];
$comments = $row['comments'];
include 'nameint_del_zero.php';
if ($pwr == "Offline") {
$twirl_color = "red";
} else {
$twirl_color = "green";
}

if ($lat == 0) {
} else {
include 'addmark2.php';
}

}
?>
