<div align="center">
<?php
    $username = "$telnet_user";
    $password = "$telnet_pass";
    $con = pfsockopen($ip, 23, $errno, $errstr, 10);
    $login = $username."\r\n";
    fwrite($con, $login);
    $pass = $password."\r\n";
    fwrite($con, $pass);
    $command = "enable\r\n";
    sleep(1);
    fwrite($con, $command);
    $enable_pass = $_GET["enable_pass"] ?? null;
  if ($enable_pass == NULL) {
} else {
    $enable_password = "$enable_pass";
    $en_pass = $enable_password."\r\n";
    fwrite($con, $en_pass);
    sleep(1);
}
    fwrite($con, "conf\r\n"); //configure
    sleep(1);
    fwrite($con, "int ".$nameint."\r\n");//enter interface    
    sleep(1);
    fwrite($con, "epon onu catv enable\r\n");//onu catv disable
    sleep(2);
$out = fread($con, 16536);
$out = preg_replace("/^(.*\n){22}/", "", $out); //only last 2 line
$tmp = explode(' -----', $out);
$out = end($tmp);
$arr_out = explode("\n", $out);
while (trim(array_pop($arr_out)) == "--More--") {
 fwrite($con, chr(32));
    sleep(2);
$arr_tmp = explode("\r\n", fread($con, 16536));
$arr_out = array_merge($arr_out,$arr_tmp);
}
fclose($con);
$count = 0;
echo "<table border=\"0\" cellspacing=\"5\">";
echo "<tr><td><div style=\"display: table-cell; vertical-align: middle; \">";
echo "TV IS ON";
echo "</div></td><td>";
echo "<td></td>";
echo "</td><td>";
echo "</td></tr>";
echo "</table>";
?>
</div>
