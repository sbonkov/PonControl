<?php
include 'vars.php';
$ip = $_GET["olt"];
$mac = $_GET["mac"];
$comments = $_POST['comments'];
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = "index.php?page=onu&olt=$ip&mac=$mac";

$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
$conn->set_charset("utf8");
//mysql_select_db($mysql_db);
$sql = "UPDATE onus SET comments=NULL, type=NULL, code=NULL WHERE mac='$mac'";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}

$conn->close();


header("Location: http://$host$uri/$extra");
?>
