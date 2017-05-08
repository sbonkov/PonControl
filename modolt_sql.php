<?php
include 'vars.php';
$extra = 'index.php';

$ip = $_GET["olt"];
$ip_new = $_POST["ip"];
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



if ($place == NULL) {
$place = " ";
} else {
}

if ($comm == NULL) {
$comm = " ";
} else {
}




if (!filter_var($ip_new, FILTER_VALIDATE_IP))
{
echo "wrong ip";
} else {

$ip_sql = sprintf('%u', ip2long($ip));
$ip_sql_new = sprintf('%u', ip2long($ip_new));

$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
mysql_query("SET NAMES utf8");
mysql_select_db($mysql_db);



$sql = "UPDATE olts SET ip='$ip_sql_new', place='$place', ro='$ro', rw='$rw', numsfp='$numsfp' WHERE ip='$ip_sql'";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}


$sql = "UPDATE onus SET olt='$ip_sql_new' WHERE olt='$ip_sql'";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}



mysql_close($conn);
header("Location: http://$host$uri/$extra?page=olt&olt=$ip_new");
}
?>
