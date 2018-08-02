<?php
$Title = 'ImgCrop';
require_once('header.php');
require_once('ImgAnimCore.php');

if (isset($_POST['ImgCropEdit'])) {
	$ImgCatID = clean($_POST['ImgCatID']);
	$ImgCropID = clean($_POST['ImgCropID']);
}

if (isset($_POST['ImgCropUpdate'])) {

	$ImgCropID = clean($_POST['ImgCropID']);
	$ImgCatID = clean($_POST['ImgCatID']);
	$DirCropWeb = B1T2P(6, $ImgCatID);

	$ValT3[2] = "'" . clean($_POST['ImgCropName']) . "'";
	$ValT3[3] = "'" . clean($_POST['ImgCropInfo']) . "'";
	$ValT3[4] = "'" . $ImgCatID . "'";
	$ValT3[5] = "'" . clean($_POST['ImgCropStatus']) . "'";
	$ValT3[6] = "'" . clean($_POST['ImgCropImgName']) . "'";
	$ValT3[7] = "'" . clean($_POST['ImgCropImgW']) . "'";
	$ValT3[8] = "'" . clean($_POST['ImgCropImgH']) . "'";
	$ValT3[9] = "'" . clean($_POST['ImgCropFilter']) . "'";
//	$ValT3[9] = "'" . clean($_POST['ImgCropFilter']) . "'";
	$ValT3[10] = "'" . hash_file('md5', $DirCropWeb.'/'.clean($_POST['ImgCropImgName'])) . "'";

	B1T3_upd($ImgCropID, $ValT3);

//echo($_SERVER["SERVER_NAME"]);
//  header("Location: ". $_SERVER["SERVER_NAME"]);
//exit; 

}

if (isset($_POST['ImgCropDel'])) {
$ImgCropID =  clean($_POST['ImgCropID']);
	B1T4_del2($ImgCropID);
	B1T3_del($ImgCropID);
}

echo('<a href="../../../index.php?do=crop" title="Home" class="btn btn-primary">Home</a>');
echo(ImgCatInfo($ImgCatID, $ImgCropID));


function ImgCatInfo($ImgCatID, $ImgCropID) {

$ImgCatName = B1T2P(2, $ImgCatID);
$ImgCropName = B1T3P(2, $ImgCropID);
$ImgCropInfo = B1T3P(3, $ImgCropID);
$ImgCropStatus = B1T3P(5, $ImgCropID);
$ImgCropImgName = B1T3P(6, $ImgCropID);
$ImgCropImgW = B1T3P(7, $ImgCropID);
$ImgCropImgH = B1T3P(8, $ImgCropID);
$ImgCropFilter = B1T3P(9, $ImgCropID);

$txt = '
<div style="width: 300px;margin: 20px auto;">
<form name="ImgCatEdit" method="post" role="form">
 
  <div class="form-group">
	<input type="hidden" name="ImgCatID" value="' . $ImgCatID . '">
	<input type="hidden" name="ImgCropID" value="' . $ImgCropID . '">
  </div>

<div class="form-group">
	<label for="ImgCat">ImgCat</label>
	<input id="ImgCat" name="ImgCat" class="form-control" type="text" value="' . $ImgCatName . '" disabled>
</div>

<div class="form-group">
	<label for="ImgCropFilter">ImgCropFilter</label>
	<input id="ImgCropFilter" name="ImgCropFilter" class="form-control" type="text" value="' . $ImgCropFilter . '">
</div>

<div class="form-group">
	<label for="ImgCropName">ImgCropName</label>
	<input id="ImgCropName" name="ImgCropName" class="form-control" type="text" size="40" value="' . $ImgCropName . '">
</div>

<div class="form-group">
	<label for="ImgCropInfo">ImgCropInfo</label>
	<input id="ImgCropInfo" name="ImgCropInfo" class="form-control" type="text" value="' . $ImgCropInfo . '">
</div>

<div class="form-group">
	<label for="ImgCropStatus">Статус</label>
	<input id="ImgCropStatus" name="ImgCropStatus" class="form-control" type="text" value="' . $ImgCropStatus . '">
</div>

<div class="form-group">
	<label for="ImgCropImgName">ImgCropImgName</label>
	<input id="ImgCropImgName" name="ImgCropImgName" class="form-control" type="text" value="' . $ImgCropImgName . '">
</div>

<div class="form-group">
	<label for="ImgCropImgW">ImgCropImgW</label>
	<input id="ImgCropImgW" name="ImgCropImgW" class="form-control" type="text" value="' . $ImgCropImgW . '">
</div>

<div class="form-group">
	<label for="ImgCropImgH">ImgCropImgH</label>
	<input id="ImgCropImgH" name="ImgCropImgH" class="form-control" type="text" value="' . $ImgCropImgH . '">
</div>

<div class="form-group">
  <button name="ImgCropUpdate" type="submit" class="btn btn-primary">Update ImgCrop</button>
  <button name="ImgCropDel" type="submit" class="btn btn-primary">Del ImgCrop</button>
</div>


</form>
</div>
';

return $txt;
}

require_once('footer.php');
?>
