<?php
$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
$conn->set_charset("utf8");
//mysql_select_db($mysql_db);
$sql = "select * from onus WHERE mac='$mac'";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}


while ($row=$retval->fetch_array(MYSQLI_BOTH)) {
$comments = $row['comments'];
}


$conn->close();
?>
