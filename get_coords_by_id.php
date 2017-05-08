<?php
$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
mysql_query("SET NAMES utf8");
mysql_select_db($mysql_db);
$sql = "select * from onus WHERE mac='$mac'";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}


while ($row=mysql_fetch_array($retval)) {
$lat = $row['lat'];
$lon = $row['lon'];
}


mysql_close($conn);


if ($lat == NULL) {
$lat = 0;
} else {
}

if ($lon == NULL) {
$lon = 0;
} else {
}


?>
