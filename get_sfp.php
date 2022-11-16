<?php
include 'vars.php';
$ip_sql = sprintf('%u', ip2long($ip));
$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
$conn->set_charset("utf8");
//mysql_select_db($mysql_db);
$sql = "select * from olts where ip='$sql_ip'";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}

  while ($row=$retval->fetch_array(MYSQLI_BOTH)) {

$numsfp = $row['numsfp'];
}


?>
