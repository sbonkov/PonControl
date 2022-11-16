<h1>Списък OLT</h1>
<br>
<div style="text-align:center;">
<form action="onu_search.php">
    <br><h2>Търсене по MAC-адрес:
    <br></h2>
    ONU MAC: <input name="mac" style="width:50%; height:30px; margin:5px; padding-left: 20px;"> </input>   
<!--   <input type="submit" value="Търсене" style="border: none; font-size:22px;" />   -->
<input type="submit" value="Търсене"  />
</form>
<?php
$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db );
if($conn->connect_errno) {
    echo "Не удалось подключиться к MYSQL";
}
$conn->set_charset("utf8");
$sql = "select * from onus where mac=$mac";
$conn->close();
?>
<br/>
</div>
<font size=4>
<?php
include 'vars.php';
$extra = 'index.php';
$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
	// $conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
if($conn->connect_errno) {
	echo "Не удалось подключиться к MYSQL";
} 
$conn->set_charset("utf8");
$sql = "create database if not exists $mysql_db  default charset utf8";
$retval = $conn->query( $sql );

if(! $retval )
{
  die('Could not enter data1: ' . mysqli_connect_error());
}

		//mysql_select_db($mysql_db);
$sql = "CREATE TABLE IF NOT EXISTS olts (   `ip` INT UNSIGNED UNIQUE,   `place` varchar(256) DEFAULT NULL,   `ro` varchar(64) DEFAULT NULL,  `rw` varchar(64) DEFAULT NULL, `last_act` varchar(64) DEFAULT NULL, `lat` varchar(16) DEFAULT NULL, `lon` varchar(16) DEFAULT NULL, `olt_comments` varchar(256) DEFAULT NULL, `numsfp` varchar(16) DEFAULT NULL, `sfp1` varchar(256) DEFAULT NULL, `sfp2` varchar(256) DEFAULT NULL, `sfp3` varchar(256) DEFAULT NULL, `sfp4` varchar(256) DEFAULT NULL, `sfp5` varchar(256) DEFAULT NULL, `sfp6` varchar(256) DEFAULT NULL, `sfp7` varchar(256) DEFAULT NULL, `sfp8` varchar(256) DEFAULT NULL, `sfp9` varchar(256) DEFAULT NULL, `sfp10` varchar(256) DEFAULT NULL, `sfp11` varchar(256) DEFAULT NULL, `sfp12` varchar(256) DEFAULT NULL, `sfp13` varchar(256) DEFAULT NULL, `sfp14` varchar(256) DEFAULT NULL, `sfp15` varchar(256) DEFAULT NULL, `sfp16` varchar(256) DEFAULT NULL)";
$retval = $conn->query( $sql );

if(! $retval )
{
  die('Could not enter data2: ' . mysqli_connect_error());
}
$sql = "select * from olts order by place";
$retval = $conn->query( $sql );

if(! $retval )
{
  die('Could not enter data3: ' . mysqli_connect_error());
}
$number = $retval->num_rows;
?>
<div align="center">
<table>
<?php
if ($number == 0) {
echo "<br>Няма OLT<br>";
echo "<a href=\"?page=addolt\">ДОБАВИ OLT</a>";
} else {
$count = 0;
  while ($row = $retval->fetch_array(MYSQLI_BOTH)) {
$count = $count + 1;
$ip_sql = $row['ip'];
$ip = long2ip($ip_sql);
$place = $row['place'];
$numsfp = $row['numsfp'];
$last_act = $row['last_act'];
$ro = $row['ro'];
$olt = str_replace (".", "_", $ip);
include 'ping.php';
if ($ping == 0) {
$color = "red";
$cell_color = "#FF0000";
}
else {
$color = "normal";
$cell_color = "#00FF00";
}
echo "<tr class=\"container\" onclick=\"document.location = '?page=olt&olt=$ip';\">";
echo "<td style=\"width: 8px; padding: 0px; background: $cell_color;\"></td>";
echo "<td style=\"text-align:center; padding: 5px;\" >$count</td><td><a href=\"?page=olt&olt=$olt\">".$ip."</a></td>";
echo "<td style=\"font-size: 18px; padding-left: 30px; min-width: 400px;\"><ul id=\"nav\"><li>";
echo "<a href=\"index.php?page=olt&olt=$ip\">";
echo $place;
echo "</a>";
echo "<ul>";
echo "<span style=\"font-size: 11px;\">";
$count_sfp = 1;
while ($count_sfp <= $numsfp) {
echo "<li><a href=\"index.php?page=olt&olt=$ip&sfp=$count_sfp\">SFP $count_sfp</a></li>";
$count_sfp = $count_sfp + 1;
}
echo "</span>";
echo "</ul>";
echo "</li></ul>";
echo "</td>";
echo "<td>".$last_act."</td></tr>";
}
$conn->close();
}
?>
</table>
</font>
</div>
<font size=3>
<div align=right>
<br/>
<a href="index.php?page=addolt">Добави ново OLT</a>
<br/>
<a href="index.php?page=ping_all">Обнови данните на всички OLT и ONU</a>
</div>
</font>
