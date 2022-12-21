<?php
echo "<div align=\"center\">РџРѕСЂС‚ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; VLAN</div>";
$num_ports = GetNumPorts($ip, $ro, $iface);
$port = 1;
while ($port <= $num_ports) {
$port_state = OnuCopperPortState($ip, $ro, $iface, $port);
$link_state = OnuCopperLinkState($ip, $ro, $iface, $port);
//$port_mode = GetPortMode($ip, $ro, $iface, $port);
$catv_rfports = GetNumCATVRFPorts($ip, $ro, $iface,$port);
$catv_status = GetCATVAdminStatus($ip, $ro, $iface, $port);

echo "<div class=\"vlans\">";
echo "<div style=\"white-space: nowrap; float: left; position: relative; width: 40px; text-align: center; \">";
echo $port;
echo "</div>";
echo "<div style=\"white-space: nowrap; float: left; vertical-align: middle; tpo: 50%; position: relative; margin: 0px; padding: 0px; overflow: hidden; display: table-cell; height: 50px; line-height: 50px;\">";
if ($port_state == 2) {
echo "<img src=\"img/ports/disabled.jpg\" title=\"РџРѕСЂС‚Р° Рµ РёР·РєР»СЋС‡РµРЅ\">";
} else if ($link_state == 1) {
echo "<img src=\"img/ports/linkup.jpg\" title=\"РџРѕСЂС‚Р° Рµ Р°РєС‚РёРІРµРЅ\">";
} else if ($link_state == 2) {
echo "<img src=\"img/ports/linkdown.jpg\" title=\"РџРѕСЂС‚Р° РЅРµ Рµ Р°РєС‚РёРІРµРЅ\">";
}
echo "</div><div style=\"white-space: nowrap; float: left; position: relative; text-align: center; width: 80px; padding-left: 10px;\">";
$vlan_edit = "vlan".$port;
include 'vlan_by_id.php';
echo "</div></div><br/>";
$port = $port + 1;
}

echo "<div style=\"white-space: nowrap; float: left; vertical-align: middle; tpo: 50%; position: relative; margin: 0px; padding: 40px; overflow: hidden; display: table-cell; height: 70px; line-height: 30px;\">";
if ($catv_rfports == 0) {
echo "<!--<img src=\"img/tv/tv_no.png\" title=\"РћРќРЈ Р±РµР· РўР’\">-->";
} else if ($catv_status == 1) {
echo "<img src=\"img/tv/tv_up.png\" title=\"РўРµР»РµРІРёР·РёСЏС‚Р° Рµ РІРєР»СЋС‡РµРЅР°\">";
//Onu CATV module rx power. Unit is 0.1 DBm
$catv_rxPower = GetCATVrxPower($ip, $ro, $iface, $port);
//echo "<br />RF РџРѕСЂС‚:";
//echo $catv_rfports;
echo "<br /><font size='-1'><b>rx power:";
echo $catv_rxPower*0.1;
echo " DBm</font></b>";
} else if ($catv_status == 2) {
echo "<img src=\"img/tv/tv_stop.png\" title=\"РўРµР»РµРІРёР·РёСЏС‚Р° Рµ РёР·РєР»СЋС‡РµРЅР°\">";
}
echo "</div><br/>";
//}
?>
