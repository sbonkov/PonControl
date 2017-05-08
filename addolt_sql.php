<?php
include 'vars.php';
$extra = 'index.php';


$table = $_POST["olt"];
$ro = $_POST["ro"];
$rw = $_POST["rw"];
$place = $_POST["place"];
$numsfp = $_POST["numsfp"];

if ($ro == NULL) {
$ro = "public";
} else {
}

if ($rw == NULL) {
$rw = "private";
} else {
}





if (!filter_var($table, FILTER_VALIDATE_IP))
{
echo "wrong ip";
} else {
$ip = $table;
$table = str_replace (".", "_", $table);
$ip_sql = sprintf('%u', ip2long($ip));
//$ip_sql = ip2long($ip);

//$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
//mysql_query("SET NAMES utf8");
//mysql_select_db($mysql_db);





$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
mysql_query("SET NAMES utf8");
mysql_select_db($mysql_db);




$sql = "CREATE TABLE IF NOT EXISTS onus (`olt` INT UNSIGNED, `name` varchar(16) DEFAULT NULL,   `mac` varchar(18) UNIQUE,   `code` varchar(256) DEFAULT NULL, `dist` varchar(16) DEFAULT NULL, `pwr` varchar(16) DEFAULT NULL, `last_pwr` varchar(16) DEFAULT NULL, `last_activity` varchar(24) DEFAULT NULL, `lat` varchar(16) DEFAULT NULL, `lon` varchar(16) DEFAULT NULL, `comments` varchar(256) DEFAULT NULL, `type` varchar(10) DEFAULT NULL)";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}



$sql = "CREATE TABLE IF NOT EXISTS onus_s (`olt` INT UNSIGNED, `mac` varchar(18), `pwr` varchar(16), `datetime` varchar(21))";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}




$sql = "INSERT INTO olts (ip, place, ro, rw, last_act, lat, lon, numsfp) VALUES ('$ip_sql', '$place', '$ro', '$rw', '01.01.2000 00:00:00', '0', '0', '$numsfp')";



$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}



include 'ping.php';


if ($ping == 0) {
echo "OLT $ip is not available";
} else {

$sql = "UPDATE olts SET last_act=\"$date\" WHERE ip='$ip_sql'";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
}


mysql_close($conn);
header("Location: http://$host$uri/$extra?page=olt_list");
}
?>
