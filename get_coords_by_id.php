<?php
$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
//fixed to work with php8.1
//$conn->query("utf8");
$conn->set_charset("utf8");
$sql = "select * from onus WHERE mac='$mac'";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}


while ($row=$retval->fetch_array(MYSQLI_BOTH)) {
$lat = $row['lat'];
$lon = $row['lon'];
}


$conn->close();


if ($lat == NULL) {
$lat = 0;
} else {
}

if ($lon == NULL) {
$lon = 0;
} else {
}


?>
