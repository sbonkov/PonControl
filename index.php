<?php
$page = $_GET["page"] ?? null;
if ($page == "onu" or $page == "onu2") {
include 'main2.php';
}else if ($page == "location") {
include 'main.php';
} else {
include 'main.php';
}
?>
