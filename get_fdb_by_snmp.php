<?php
include 'get_ro.php';
include 'get_fdb_by_snmp.php'
$ip = $_GET["olt"];
$ro = $row['ro'];
$iface = $_GET["iface"];
$fdb = GetFdb($ip, $ro, $iface);
foreach ($fdb as $oid => $fdb_mac) {
$fdb_vlan = end(explode("1.3.6.1.4.1.3320.152.1.1.3.$iface.", $oid));
$fdb_vlan = explode('.', $fdb_vlan);
$fdb_vlan = $fdb_vlan[0];
$fdb_mac = trim(end(explode('STRING: ', $fdb_mac)));
$fdb_mac = str_replace(' ',':',$fdb_mac);

echo $fdb_vlan;
echo " - ";
echo $fdb_mac;
echo "\r\n";
echo "<br/>";
}
?>