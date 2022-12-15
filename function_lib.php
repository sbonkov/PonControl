<?php
//new START

// ---------- secconds to date time () ----------
function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
}


// ---------- Get CATVrxPower DBm () ----------

function GetCATVrxPower($ip, $ro, $iface, $port) {
$catv_rxPower = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.10.31.1.2.$iface.$port");
$catv_rxPower = end(explode('INTEGER: ', $catv_rxPower));
return $catv_rxPower;
}

// END ----------

// ---------- Get CATVRF status () ----------

function GetCATVAdminStatus($ip, $ro, $iface, $port) {
$catv_status = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.10.30.1.2.$iface.$port");
$catv_status = end(explode('INTEGER: ', $catv_status));
return $catv_status;
}

// END ----------

// ---------- Get CATVRF Port num () ----------

function GetNumCATVRFPorts($ip, $ro, $iface, $port) {
$catv_rfports = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.10.3.1.15.$iface");
$catv_rfports = end(explode('INTEGER: ', $catv_rfports));
return $catv_rfports;
}

// END ----------


// ---------- Get Port Mode (trunk, access, etc.) ----------

function GetPortMode($ip, $ro, $iface, $port) {
$port_mode = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.12.1.1.18.$iface.$port");
$port_mode = end(explode('INTEGER: ', $port_mode));
return $port_mode;
}

// ---------- Get ONU Vendor ID (BDCM, CDT etc.) ----------

function GetVendorID($ip, $ro, $iface) {
$vendor_id = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.10.1.1.1.$iface");
$vendor_id = end(explode('INTEGER: ', $vendor_id));
return $vendor_id;
}

// ---------- Get ONU Model ID () ----------

function GetModelID($ip, $ro, $iface) {
$model_id = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.10.1.1.2.$iface");
$model_id = end(explode('STRING: ', $model_id));
return $model_id;
}

// ---------- Get onu alive time (onu online time) ----------

function GetOnuAliveTime($ip, $ro, $iface) {
$onu_alivetime = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.10.1.1.80.$iface");
$onu_alivetime = end(explode('INTEGER: ', $onu_alivetime));
return $onu_alivetime;
}

// END ----------

//new END

// ---------- Correct function ip2long for work on 32bit systems

function ip2longfixed($ip) {
$sql_ip = sprintf('%u', ip2long($ip));
return $sql_ip;
}

// END ----------



// ----------Get PVID on port ----------

function GetPVID($ip, $ro, $iface, $port) {
$pvid = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.12.1.1.3.$iface.$port");
$pvid = end(explode('INTEGER: ', $pvid));
return $pvid;
}


// ----------Get num ports on ONU ----------

function GetNumPorts($ip, $ro, $iface) {

$Array_num_ports = snmprealwalk($ip, $ro, "1.3.6.1.4.1.3320.101.12.1.1.8.$iface");
if(count($Array_num_ports)>0)
 foreach($Array_num_ports as $oid => $result)
 {
   $num_ports = $oid;
 }
$num_ports = end(explode("12.1.1.8.$iface.", $num_ports));
return $num_ports;
}

// END ----------






// ----------Get copper port state on ONU ----------

function OnuCopperPortState($ip, $ro, $iface, $port) {
$port_state = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.12.1.1.7.$iface.$port");
$port_state = end(explode('INTEGER: ', $port_state));
// 1 - Enabled, 2 - Disabled
return $port_state;
}

// END ----------


// ----------Get copper link state on ONU ----------

function OnuCopperLinkState($ip, $ro, $iface, $port) {
$link_state = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.12.1.1.8.$iface.$port");
$link_state = end(explode('INTEGER: ', $link_state));
// 1 - Link down, 2 - Link up
return $link_state;
}

// END ----------





// ---------- Get iface number on OLT by MAC ONU ----------
function IfaceByMac($ip, $ro, $mac) {
$mac_spaced = str_replace(':',' ',$mac);
$mac_spaced = str_replace('a','A',$mac_spaced);
$mac_spaced = str_replace('b','B',$mac_spaced);
$mac_spaced = str_replace('c','C',$mac_spaced);
$mac_spaced = str_replace('d','D',$mac_spaced);
$mac_spaced = str_replace('e','E',$mac_spaced);
$mac_spaced = str_replace('f','F',$mac_spaced);

$Array_descr = snmprealwalk($ip, $ro, ".1.3.6.1.4.1.3320.101.10.1.1.3");

 if(count($Array_descr)>0)
 {
 foreach($Array_descr as $key => $type)
 {

$key = end(explode('10.1.1.3.', $key));

$real_mac_spaced = trim(end(explode('STRING: ', $type)));
if ($real_mac_spaced == $mac_spaced) {
$iface = $key;
}

}

}
return $iface;
}
// END ----------



// ----------Get distance to ONU by Iface----------

function DistById($ip, $ro, $iface) {
$dist = snmp2_get($ip, $ro, ".1.3.6.1.4.1.3320.101.10.1.1.27.$iface");
$dist = end(explode('INTEGER: ', $dist));
return $dist;
}

// END ----------



// ----------Get RX level by Interface ID----------

function RxById($ip, $ro, $iface) {
// Get RX level with "INTEGER: "
  $rx = snmp2_get($ip, $ro, ".1.3.6.1.4.1.3320.101.10.5.1.5.$iface");

// Get CLEAN RX level
$rx = end(explode('INTEGER: ', $rx));
$rx = end(explode('OID', $rx));
if ($rx == 0 OR !$rx OR $rx == NULL OR $rx == -65536) {
$rx = "Offline";
} else {
$rx=($rx/10);

$rx=sprintf("%.1f", $rx);
}
return $rx;
}

// END ----------Get RX level by Interface ID----------






// ----------Get PON interface name by Interface ID----------


function NameById($ip, $ro, $iface) {
$iface_name = snmp2_get($ip, $ro, "1.3.6.1.2.1.2.2.1.2.$iface");

//Get CLEAN name
$iface_name = end(explode(' ', $iface_name));
$iface_name = str_replace("\"", "", $iface_name);


return $iface_name;
}

// END ----------Get PON interface name by Interface ID----------





// ----------Get MAC ADDRESS of ONU by nterface ID----------
function MacById($ip, $ro, $iface) {
$mac = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.10.1.1.3.$iface");
$mac = trim(end(explode(':', $mac)));
$mac = str_replace (" ", ":", $mac);
return $mac;
}

// END ----------

// ----------Get TEMPERATURE of ONU by nterface ID----------
function TempById($ip, $ro, $iface) {
$temp = snmp2_get($ip, $ro, "1.3.6.1.4.1.3320.101.10.5.1.2.$iface");
$temp = end(explode(' ', $temp));
$temp = $temp/256;
return $temp;
}

// END ----------


// ---------- Delete zero from interface name for correct sorting ----------

function NameIntDelZero($nameint) {
$nameint = str_replace (":0", ":", $nameint);
return $nameint;
}

// END ----------


// ---------- Add zero to interface name for correct sorting ----------

function NameIntAddZero($nameint) {
$end = end(explode(':', $nameint));
$count = strlen($end);
if ($count == 1){
$nameint = str_replace (":1", ":01", $nameint);
$nameint = str_replace (":2", ":02", $nameint);
$nameint = str_replace (":3", ":03", $nameint);
$nameint = str_replace (":4", ":04", $nameint);
$nameint = str_replace (":5", ":05", $nameint);
$nameint = str_replace (":6", ":06", $nameint);
$nameint = str_replace (":7", ":07", $nameint);
$nameint = str_replace (":8", ":08", $nameint);
$nameint = str_replace (":9", ":09", $nameint);

}
return $nameint;
}

// END ----------




// ---------- MYSQL update last activity of OLT ----------
function UpdateOltLastAct($conn, $sql_ip, $date) {
$sql = "UPDATE olts SET last_act='$date' WHERE ip='$sql_ip'";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}
}

// END ----------





// ---------- MYSQL Update/Add ONU ----------
function UpdateOnu($conn, $sql_ip, $date, $nameint, $mac, $rx) {


$sql = "INSERT INTO onus (olt,name,mac,pwr) VALUES ('$sql_ip','$nameint','$mac','$rx') ON DUPLICATE KEY UPDATE name=VALUES(name), olt=VALUES(olt),pwr=VALUES(pwr)";
$retval = $conn->query( $sql );
if(! $retval )
{
}

if ($rx == "Offline") {
$rx = 0;
} else {



$sql = "UPDATE onus SET olt='$sql_ip',last_pwr='$rx',last_activity='$date' WHERE mac='$mac'";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}

}



$sql = "INSERT INTO onus_s (olt,mac,pwr,datetime) VALUES ('$sql_ip','$mac','$rx','$date')";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}




}

// END ----------




?>

