<?php
include 'vars.php';
$extra = 'index.php';


$table = $_GET["olt"];
$ip = str_replace ("_", ".", $table);
$sql_ip = sprintf('%u', ip2long($ip));
$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
mysql_query("SET NAMES utf8");
mysql_select_db($mysql_db);



$sql = "DELETE FROM olts WHERE ip='$sql_ip'";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

$sql = "DELETE FROM onus WHERE olt='$sql_ip'";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}



$sql = "DELETE FROM onus_s WHERE olt='$sql_ip'";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}





mysql_close($conn);
header("Location: http://$host$uri/$extra?page=olt_list");

?>
