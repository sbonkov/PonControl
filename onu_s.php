История на нивата
<br/>
<br/>
<?php

echo "<br/><font size=\"2\">Покажи последните&nbsp;&nbsp;";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&show=onu_s&count=50\">50</a> &nbsp;&nbsp;";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&show=onu_s&count=100\">100</a> &nbsp;&nbsp;";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&show=onu_s&count=500\">500</a> &nbsp;&nbsp;";
echo "<a href=\"?page=onu&olt=$ip&mac=$mac&show=onu_s&count=1000\">1000</a> &nbsp;&nbsp;";
echo "стойности</font><br/><br/><div align=\"center\">";

if ($count==NULL) {
$count=50;
} else {
}

$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
$conn->set_charset("utf8");
//mysql_select_db($mysql_db);
$sql = "select * from ( select * from onus_s where mac=\"$mac\" order by datetime desc limit $count ) sub order by datetime DESC;";
$retval = $conn->query( $sql );
if(! $retval )
{
  die('Could not enter data: ' . mysqli_connect_error());
}
$number = $retval->num_rows;

?>
<table border="0"  cellpadding="10" cellspacing="0">



<?php
if ($number == 0) {
echo "Няма данни";
} else {

  while ($row=$retval->fetch_array(MYSQLI_BOTH)) {

$pwr = $row['pwr'];
$datetime = $row['datetime'];

echo "<tr class=\"rx\"><td class=\"rx\">$datetime</td><td class=\"rx\">&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"orange\">$pwr</font></td></tr>";

}

}
$conn->close();
echo "</table></div>";
//echo "<img src=\"graph_test.php?olt=$tables&iface=$iface\">";
?>

