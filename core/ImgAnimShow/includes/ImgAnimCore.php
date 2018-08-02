<?php
include('../../../config.php');
require_once(DIRDB1);

function ImgPointsPars($Points) {
//clean($_POST['coords1'])
//$Points = '156,113,285,130,246,233';

$PointsPars = explode(",", $Points);
$count = count($PointsPars);

for ($i = 0; $i < $count; $i++) {
if(($i % 2) === 0) {
	$txt .= $PointsPars[$i].',';
}else{
	//$txt .= $PointsPars[$i].' ';
	if (end($PointsPars) != $PointsPars[$i]) {
		$txt .= $PointsPars[$i].' ';
	}else{
		$txt .= $PointsPars[$i];
	}

}
}
return $txt;
}

?>
