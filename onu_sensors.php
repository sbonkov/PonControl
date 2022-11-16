<?php
echo "<div style=\"display: table; text-align: left; white-space: nowrap; width: 100%;\">";
echo "<h1>".$comments."</h1>";
if ($edit == "true" OR ($code == NULL AND $comments == NULL)) {
echo "<br/>";
                                                                 if ($use_userside == "yes") {
                                                                 include 'onu_code.php';
                                                                } else {
                                                                include 'onu_comments.php';
                                                                }

} else {
echo "<span style=\"font-size: 10px;\"><a href=\"index.php?page=onu&olt=$ip&mac=$mac&edit=true\">[редактиране на описанието]</a></span><br/>";
}
include "vars.php";
$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
if($conn->connect_errno){
    echo "Няма връзка със MYSQL";
}
$conn->set_charset("utf8");
$onu_ip = ip2long($_GET['olt']);
$sql = "select * from olts where ip=$onu_ip";
$retval = $conn->query($sql);
$row = $retval->fetch_array(MYSQLI_BOTH);
//OLT IP
$olt = $_GET["olt"];
$conn->close();
echo "<br/><br/><br/>";
echo "<div style=\"float: left; display: table-cell; vertical-align: middle; top: 50%;\">";
echo "<b>";
$ipaddr=long2ip($row['ip']);
//echo "OLT IP: <a href=\"http://$ipaddr\" target=\"_blank\">$ipaddr</a>";
echo "OLT IP: <a href=\"http://$olt\" target=\"_blank\">$olt</a>";
echo "<br>";
echo "<br>";
#echo "<a href=\"?page=onu&olt=$ip&mac=$mac\">$nameint</a>";
echo $nameint;
echo "</b><br/>";
echo "<b>";
#echo "<a href=\"".$search_string.$mac."\" target=\"_blank\">";
echo $mac;
echo "</a>";
echo "</b><br/>";
if ($rx == "Offline") {
include 'get_lastact_onu.php';
echo "<span style=\"color:#FF0000; font-size: 12px;\";>";
echo "<b>Последна активност:</b>";
echo "<br/>";
echo $last_act;
echo "<br/>";
echo $last_pwr;
echo " dB</span><br/><br/><br/>";
echo "<font size=\"4\">";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&show=onu_s\"><img width=\"32\" src=\"images/optic.png\"> История на нивата</a>";
echo "<br/>";
echo "<a href=\"?page=reboot_onu&olt=$ip&iface=$iface\"><img width=\"32\" src=\"images/reboot.png\"> Рестартиране на ONU</a>";
echo "</font>";
echo "</div>";
echo "<div style=\"float: left; position:relative; left: 100px;\">";
echo "ONU OFFLINE";
} else {
echo "<span class=\"rx\">$rx";
echo " dB</span><br/>";
echo "<b>";
echo $dist;
echo "</b><font size=2>m</font><br/><br/><br/>";
echo "<font size=\"4\">";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&fdb=show\"><img width=\"32\" src=\"images/fdb.png\"> МАК на клиента</a>";
echo "<br/>";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&show=onu_s\"><img width=\"32\" src=\"images/optic.png\"> История на нивата</a>";
echo "<br/>";
echo "<a href=\"?page=reboot_onu&olt=$ip&iface=$iface\"><img width=\"32\" src=\"images/reboot.png\"> Рестартиране на ONU</a>";
echo "</font>";
echo "</div>";
echo "<div style=\"float: left; position: relative; padding-left: 100px; white-space: nowrap; line-height: 50px; display: inline; vertical-align: middle; top: 50%;\">";
include 'get_ports.php';
}
echo "</div>";
echo "</div>";
echo "</div>";
?>
