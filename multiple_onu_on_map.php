<?php
include 'vars.php';
$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
$conn->set_charset("utf8");
//mysql_select_db($mysql_db);
if(! $conn )
{
  die('Could not connect: ' . mysqli_connect_error());
}
$ip_sql = sprintf('%u', ip2long($ip));
$sql = "SELECT * FROM onus WHERE name LIKE \"EPON0/$sfp%\" AND olt=\"$ip_sql\"";
$res = $conn->query($sql) or die(mysql_error());

 while ($row=$res->fetch_array(MYSQLI_BOTH)) {

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
