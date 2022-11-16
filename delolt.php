<?php
include 'vars.php';
$extra = 'index.php';


$table = $_GET["olt"];
$ip = str_replace ("_", ".", $table);
$sql_ip = sprintf('%u', ip2long($ip));
$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
$conn->set_charset("utf8");
//mysql_select_db($mysql_db);



$sql = "DELETE FROM olts WHERE ip='$sql_ip'";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}

$sql = "DELETE FROM onus WHERE olt='$sql_ip'";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}



$sql = "DELETE FROM onus_s WHERE olt='$sql_ip'";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}





$conn->close();
header("Location: http://$host$uri/$extra?page=olt_list");

?>
