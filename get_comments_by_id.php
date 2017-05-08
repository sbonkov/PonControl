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
$comments = $row['comments'];
}


mysql_close($conn);
?>
