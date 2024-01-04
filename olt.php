<?php
include 'vars.php';
$extra = 'index.php';
$table = $_GET["olt"];
$search = $_GET["search"] ?? null;
$ip = str_replace ("_", ".", $table);
$sql_ip = sprintf('%u', ip2long($ip));
$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
$conn->set_charset("utf8");
$sql = "select * from olts where ip='$sql_ip'";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}
?>
<h2>
<?php
if ($search == NULL) {
echo "OLT";
} else {
echo "Търси по OLT";
}
?>
</h2>
<br/>
<br/>
<font size=4>
<table border="0"  cellpadding="8" cellspacing="13">
<?php
  while ($row = $retval->fetch_array(MYSQLI_BOTH)) {
$numsfp = $row['numsfp'];
$place = $row['place'];
$ro = $row['ro'];
$last_act = $row['last_act'];
echo "$ip";
echo "<br/>";
echo $place;
echo "<br/><br/>";
include 'set_sfp.php';
}
include 'ping.php';
//Count offline ONU
$sql = "select * from onus WHERE olt=\"$sql_ip\" AND pwr=\"Offline\" OR pwr=\"0\"";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}
$num_offline = $retval->num_rows;
//Count online ONU
$sql = "select * from onus WHERE olt=\"$sql_ip\" AND pwr<>\"Offline\"";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}
$num_online = $retval->num_rows;
//Count all ONU
$sql = "select * from onus WHERE olt=\"$sql_ip\"";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}
$num_all = $retval->num_rows;
echo "<br/>";
echo "<span style=\"font-size: 14px;\">";
if ($ping == 0) {
echo "<font color=\"#FF0000\"><b>$num_all ONU</b></font>";
} else {
echo "<font color=\"#00AA00\"><b>$num_online</b> Online</font>/<font color=\"#FF0000\"><b>$num_offline</b> Offline</font>";
}
echo "</span>";
$conn->close(); ?> </table> </font>
<div align="center">
<div class="top_container">
  <div class="top_box">
<!--<div><a href="index.php?page=map_onu&olt=<?php echo $table; ?>"><img width="32" src="images/map.png"><br/>Карта Onu</a><-->
<div><a href="?page=get_snmp&olt=<?php echo $table;?>" onclick="return confirm('Обновяване данните на OLT? Времето за изпълнение може да бъде няколко минути')"><img width="32" src="images/radar.png"><br/>Обнови Данните</a></div>
<div><a href="?page=modolt&olt=<?php echo $table;?>"><img width="32" src="images/edit.png"><br/>Редактиране на OLT</a></div>
<div><a href="?page=delolt&olt=<?php echo $table;?>" onclick="return confirm('Да изтрия ли OLT? Ако не си Админа недей.')"><img width="32" src="images/delete.png"><br/>Изтрий OLT</a></div>
  </div>
</div>
</div>
<br/>
<br/>
<div align=center>
<?php
include 'onu_sql.php';
?>
</div>
