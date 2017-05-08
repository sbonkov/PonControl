<?php
include 'vars.php';
$mac = $_GET["mac"];
$ip = $_GET["olt"];
include 'get_rw.php';
$iface = $_GET["iface"];
$port = $_GET["port"];
$port_state_up = $_POST['port_state_up'];
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = "index.php?page=onu&olt=$ip&mac=$mac";
snmp2_set($ip, $rw, "1.3.6.1.4.1.3320.101.12.1.1.7.$iface.$port", i, "1");
//snmp2_set($ip, $rw, "1.3.6.1.4.1.3320.20.15.1.1.0", i, "1");
header("Location: http://$host$uri/$extra");
?>