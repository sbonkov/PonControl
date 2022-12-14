<?php


$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';
include 'vars.php';
$fdb = $_GET["fdb"];
$ip = $_GET["olt"];
$maptype = $_GET["maptype"];
$count = $_GET["count"];
$include = $_GET["show"];
$edit = $_GET["edit"];
if ($include == NULL) {
} else {
$include = $include.".php";
}
$mac = $_GET["mac"];
include 'get_ro.php';
include 'get_rw.php';

include_once 'function_lib.php';

$iface = IfaceByMac($ip, $ro, $mac);
$rx = RxById($ip, $ro, $iface);
$nameint = NameIntDelZero(NameById($ip, $ro, $iface));
$dist = DistById($ip, $ro, $iface);

if ($use_userside == "yes") {
include 'get_code_by_id.php';
if ($code == NULL) {
include 'get_comments_by_id.php';
} else {
include 'get_us_data.php';
include 'make_comments_by_us.php';
}
} else {
include 'get_comments_by_id.php';
}

include 'get_coords_by_id.php';
$pwr = $rx;


?>
<!DOCTYPE HTML>
<html>
<head>
<?php
if ($lat == 0) {
}
else {
include 'map.php';
}
?>
<title>Pon</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="style/css/ie7.css" media="all" /><![endif]-->

</head>
<body>
<div id="contain">
  <!-- Begin Header Wrapper -->
  <div id="page-top">
    <div id="header-wrapper">
      <!-- Begin Header -->
      <div id="header">
        <div id="logo"><a href="index.php"><img src="images/logo.png" alt="" /></a></div>
        <!-- Logo -->
        <!-- Begin Menu -->
        <div id="menu-wrapper">
          <div id="smoothmenu1" class="ddsmoothmenu">
            <ul>
					<li><a href="<?php echo $left_href3; ?>"><?php echo $left_href_txt3; ?></a></li>
                                        <li><a href="<?php echo $left_href; ?>"><?php echo $left_href_txt; ?></a></li>
                                        <li><a href="<?php echo $left_href2; ?>"><?php echo $left_href_txt2; ?></a></li>
                </ul>
          </div>
        </div>
        <!-- End Menu -->
      </div>
      <!-- End Header -->
    </div>
  </div>
  <!-- End Header Wrapper -->
  <!-- Begin Wrapper -->
  <div id="wrapper">
  <div id="container">

<?php include "$page.php"; ?>

  </div>
  </div>
  <!-- End Wrapper -->
  <div class="clearfix"></div>
  <div class="push"></div>
  <!-- Begin Footer -->
  <div id="footer-wrapper">
    <div id="footer">
      <div id="footer-content">
        <!-- Begin Copyright -->
        <div id="copyright">
          <p><br></p>
        </div>
        <!-- End Copyright -->
      </div>
    </div>
  </div>
  <!-- End Footer -->
</div>
</body>
</html>
