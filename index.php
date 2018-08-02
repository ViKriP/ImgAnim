<?php
//header("X-Frame-Options: SAMEORIGIN");

require_once('config.php');

$do = $_GET['do'];

if ($do == 'show') {
	require_once('core/ImgAnimShow/index.php');
} elseif ($do == 'crop') {
	require_once('core/ImgAnimCrop/index.php');
}
?>
