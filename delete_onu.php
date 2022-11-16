<?php
include 'vars.php';
$mac = $_GET["mac"];
//$ip = $_GET["ip"];
$sfp = $_GET["sfp"];
include 'get_rw.php';

if ($mac == NULL) {
echo "Грешка: не е указан MAC ONU";
} else if ($sfp == NULL) {
echo "Грешка: не е указан № на интерфейса";
} else {


$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
$conn->set_charset("utf8");


$sql = "DELETE FROM onus WHERE name LIKE \"EPON0/$sfp%\" AND mac LIKE \"$mac\" ";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}

$conn->close();
header("Location: http://$host$uri/$extra?page=olt_list");
}
?>
