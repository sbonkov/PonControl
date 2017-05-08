<?php
include 'vars.php';
$ip = $_GET["olt"];
$mac = $_GET["mac"];
$comments = $_POST['comments'];
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = "index.php?page=onu&olt=$ip&mac=$mac";

$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
mysql_query("SET NAMES utf8");
mysql_select_db($mysql_db);
$sql = "UPDATE onus SET comments='$comments' WHERE mac='$mac'";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

mysql_close($conn);


header("Location: http://$host$uri/$extra");
?>
