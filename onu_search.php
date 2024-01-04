<?php
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';
include 'vars.php';
$MAC = $_GET["mac"];
if($MAC == ""){
    $link="index.php";
    header("Location: $link");
    exit();
}
$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
if($conn->connect_errno){
    echo "Няма връзка с MYSQL";
}
$conn->set_charset("utf8");
$sql = "select * from onus where mac=\"$MAC\"";
$retval = $conn->query($sql);
$number = $retval->num_rows;
if($number > 1){
    echo "MAC-овете са по-вече от един";
}
else if($number == 1) {
    $row = $retval->fetch_array(MYSQLI_BOTH);
    $olt_ip=long2ip($row['olt']);
    $link = "index.php?page=onu&olt=$olt_ip&mac=$MAC";
    header("Location: $link");
    $conn->close();
}
else {
    $link="index.php";
    header("Location: $link");
}
//$conn->close();
?>
