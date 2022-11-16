<?php
include 'vars.php';
$extra = 'index.php';

$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
$conn->set_charset("utf8");
//mysql_select_db($mysql_db);
$psql = "select * from olts order by ip";
$pretval = $conn->query( $psql );
if(! $pretval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}

  while ($row = $pretval->fetch_array(MYSQLI_BOTH)) {



$sql_ip = $row['ip'];
$ro = $row['ro'];
$ip = long2ip($sql_ip);
include 'ping.php';

if ($ping == 0) {
} else {

$sql_req = "UPDATE olts SET last_act=\"$date\" WHERE ip='$sql_ip'";
$retval_ping = $conn->query( $sql_req );
if(! $retval_ping )
{
  die('Could not enter data: ' . mysqli_connect_error());
}

$table = str_replace (".", "_", $ip);
include 'get_snmp.php';

}

}
$conn->close();
header("Location: http://$host$uri/$extra?page=olt_list");

?>
