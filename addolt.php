<div align=center>
<h1>
Добави OLT
</h1>
<br/>
<form method="post" action="addolt_sql.php">
IP адрес: <input required name="olt" size=13 type="text" id="olt" placeholder="OLT" style="margin:5px"><br/>
SNMP ro: <input name="ro" size=13 type="text" id="ro" placeholder="Read Community" style="margin:5px"><br/>
SNMP rw: <input name="rw" size=13 type="text" id="rw" placeholder="Write Community" style="margin:5px"><br/>
Локация: <input name="place" size=13 type="text" id="place" placeholder="Место установки" style="margin:5px"><br/>
Количество PON SFP <input required name="numsfp" size=13 type="text" id="numsfp" value="4" style="margin:5px"><br/>
<br/>
<input name="add" type="submit" id="add" value="ADD OLT" style="width:80px; margin:5px">
</form>
</div>
