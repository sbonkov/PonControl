<?php

$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
mysql_query("SET NAMES utf8");
mysql_select_db($mysql_db);
$sql_ip = sprintf('%u', ip2long($ip));
$sql = "select * from olts where ip='$sql_ip'";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}


  while ($row=mysql_fetch_array($retval)) {
$rw = $row['rw'];
}
?>
