<?php
echo "<div style=\"display: table; text-align: left; white-space: nowrap; width: 100%;\">";
echo "<h1>".$comments."</h1>";
//if ($edit == "true" OR ($code == NULL AND $comments == NULL)) {
if ($edit == "true" OR ($comments == NULL)) {
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
$olt = $_GET["olt"];
$place = $row['place'];
$vendor_id = GetVendorID($ip, $ro, $iface);
$model_id = GetModelID($ip, $ro, $iface);
$onu_alivetime = GetOnuAliveTime($ip, $ro, $iface);
$temp = TempById($ip, $ro, $iface);
$conn->close();
//echo "<br/>";
echo "<div style=\"float: left; display: table-cell; vertical-align: middle; top: 50%;\">";
echo "<b>";
$ipaddr=long2ip($row['ip']);
echo "OLT: <a href=\"http://$olt\" target=\"_blank\"><b>$place</b></a>";
echo "<br>";
echo "<br>";
#echo "<a href=\"?page=onu&olt=$ip&mac=$mac\">$nameint</a>";
echo $nameint;
echo "</b><br/>";
echo "<b>";
#echo "<a href=\"".$search_string.$mac."\" target=\"_blank\">";
echo "МАК: $mac";
echo "<br>";
echo "Производител: $vendor_id";
echo "<br>";
$result = str_replace(' ', '', $model_id); //remove blank space
$model = hex2bin($result); //HEX to string
echo "Модел: $model";
//echo "Модел: $model_id"; //HEX
echo "<br>";
echo mb_strimwidth('Температура: '.$temp, 0, 19, '°C'); //show short ONU temp
echo "<br>";
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
echo "<span class=\"rx\">Нива: $rx";
echo " dB</span><br/>";
echo "<b>";
echo "Дистанция: $dist";
echo "</b><font size=2>m</font>";
//echo "<br /><b><font size=2>$onu_alivetime</font></b>";
echo "<br /><b><font size=2>Онлайн: ";
echo secondsToTime($onu_alivetime);
echo "</font></b>";
echo "<br /><br/><br/>";
echo "<font size=\"4\">";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&fdb=show\"><img width=\"32\" src=\"images/fdb.png\"> МАК на клиента</a>";
echo "<br/>";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&show=onu_s\"><img width=\"32\" src=\"images/optic.png\"> История на нивата</a>";
echo "<br/>";
echo "<a href=\"?page=reboot_onu&olt=$ip&iface=$iface\"><img width=\"32\" src=\"images/reboot.png\"> Рестартиране на ONU</a>";
echo "</font>";
echo "</div>";
echo "<div style=\"float: left; position: relative; padding-left: 100px; white-space: nowrap; line-height: 50px; display: inline; vertical-align: middle; top: 20%;\">";
include 'get_ports.php';
}
echo "</div>";
echo "</div>";
echo "</div>";
?>
