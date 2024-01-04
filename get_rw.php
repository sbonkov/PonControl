<?php
$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
$conn->set_charset("utf8");
$sql_ip = sprintf('%u', ip2long($ip));
$sql = "select * from olts where ip='$sql_ip'";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}
  while ($row=$retval->fetch_array(MYSQLI_BOTH)) {
$rw = $row['rw'];
}
?>
