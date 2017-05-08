<?php
include 'vars.php';
$table = $_GET["olt"];
$ip = str_replace ("_", ".", $table);
$ip_sql = sprintf('%u', ip2long($ip));

$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
mysql_query("SET NAMES utf8");
mysql_select_db($mysql_db);
$sql = "select * from olts where ip='$ip_sql'";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

  while ($row=mysql_fetch_array($retval)) {
$place = $row['place'];
$numsfp = $row['numsfp'];
$ro = $row['ro'];
$rw = $row['rw'];
}






?>
<div align=center>
<h2>
Редактирование OLT
</h2>
<br/>
<br/>
<form method="post" action="modolt_sql.php?olt=<?php echo $ip; ?>">
IP адрес: <input required name="ip" size=13 type="text" id="ip" value="<?php echo $ip; ?>"><br/>
SNMP ro: <input name="ro" size=13 type="text" id="ro"  value="<?php echo $ro; ?>"><br/>
SNMP rw: <input name="rw" size=13 type="text" id="rw"  value="<?php echo $rw; ?>"><br/>
Место: <input name="place" size=13 type="text" id="place"  value="<?php echo $place; ?>"><br/>
Кол-во PON SFP: <input name="numsfp" size=13 type="text" id="numsfp"  value="<?php echo $numsfp; ?>"><br/>
<br/>
<input name="add" type="submit" id="add" value="Сохранить" style="width:80px">
</form>
</div>
