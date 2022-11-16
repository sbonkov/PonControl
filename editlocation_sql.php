<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'lfgj[eqnfrbcnfdm';
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$olt = $_GET["olt"];
$mac = $_GET["mac"];
$extra = "index.php?page=onu&olt=$olt&mac=$mac";
include 'vars.php';


$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
$conn->set_charset("utf8");
if(! $conn )
{
  die('Could not connect: ' . mysqli_connect_error());
}

if(! get_magic_quotes_gpc() )
{
   $latlongmet = addslashes ($_POST['latlongmet']);

}
else
{
   $latlongmet = $_POST['latlongmet'];

}
$lat = substr($latlongmet, 0, -8);
$lon = substr($latlongmet, 8);



$sql = "UPDATE onus ".
       "SET lat=\"$lat\", lon=\"$lon\" WHERE mac=\"$mac\"";
//mysql_select_db($mysql_db);
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

header("Location: http://$host$uri/$extra");
$conn->close();

?>
