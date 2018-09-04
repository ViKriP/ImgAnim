<?php
//error_reporting(E_ALL); ini_set('display_errors', true);

$Title = 'ImgCropFilter';
require_once('header.php');
require_once('ImgAnimCore.php');

//	$ImgCatID = clean($_POST['ImgCatID']);
	$ImgCatID = clean($_POST['IDImgCat']);
	$cr = 'false';

if (isset($_POST['ImgCropFilterID'])) {
	$ImgCatID = clean($_POST['ImgCatID']);
	$ImgCropFilterNow = clean($_POST['ImgCropFilterID']);
	$cr = clean($_POST['cr']);
}

if (isset($_POST['ImgCropFilterCr'])) {
	$cr = 'true';
}

if (isset($_POST['ImgCropFilterUpd'])) {
	$cr = 'false';
	$ImgCatID = clean($_POST['ImgCatID']);
}



if (isset($_POST['ImgCropFilterUpdate'])) {
	//$ImgCatID = clean($_POST['ImgCatID']);

	$ValT5[2] = "'" . clean($_POST['ImgCropFilterName']) . "'";
	$ValT5[3] = "'" . clean($_POST['ImgCropFilterInfo']) . "'";
	$ValT5[4] = "'" . clean($_POST['ImgCatID']) . "'";

	B1T5_upd(clean($_POST['ImgCropFilterID']), $ValT5);
}

if (isset($_POST['ImgCropFilterDel'])) {
	$ImgCatID = clean($_POST['ImgCatID']);

B1T5_del(clean($_POST['ImgCropFilterID']));
}

if (isset($_POST['ImgCropFilterCreate'])) {
	$ImgCatID = clean($_POST['ImgCatID']);

	$ValT5[2] = "'" . clean($_POST['ImgCropFilterName']) . "'";
	$ValT5[3] = "'" . clean($_POST['ImgCropFilterInfo']) . "'";
	$ValT5[4] = "'" . $ImgCatID . "'";

B1T5_ins($ValT5);
}

/*if (isset($_POST['ImgCropFilterEdit'])) {
	$ImgCatID = clean($_POST['ImgCatID']);
	//$ImgCropID = clean($_POST['ImgCropID']);
}

if (isset($_POST['ImgCropFilterUpdate'])) {

	//$ImgCropID = clean($_POST['ImgCropID']);
	$ImgCatID = clean($_POST['ImgCatID']);
	$DirCropWeb = B1T2P(6, $ImgCatID);

	$ValT3[2] = "'" . clean($_POST['ImgCropName']) . "'";
	$ValT3[3] = "'" . clean($_POST['ImgCropInfo']) . "'";
	$ValT3[4] = "'" . $ImgCatID . "'";
	$ValT3[5] = "'" . clean($_POST['ImgCropStatus']) . "'";
	$ValT3[6] = "'" . clean($_POST['ImgCropImgName']) . "'";
	$ValT3[7] = "'" . clean($_POST['ImgCropImgW']) . "'";
	$ValT3[8] = "'" . clean($_POST['ImgCropImgH']) . "'";
	$ValT3[9] = "'" . clean($_POST['ImgCropFilterID']) . "'";
	$ValT3[10] = "'" . hash_file('md5', $DirCropWeb.'/'.clean($_POST['ImgCropImgName'])) . "'";
//echo $_POST['ImgCropFilterID'];
	B1T3_upd($ImgCropID, $ValT3);

//echo($_SERVER["SERVER_NAME"]);
//  header("Location: ". $_SERVER["SERVER_NAME"]);
//exit; 

}

if (isset($_POST['ImgCropFilterDel'])) {
//$ImgCropID =  clean($_POST['ImgCropID']);
	B1T4_del2($ImgCropID);
	B1T3_del($ImgCropID);
}
*/
echo('<a href="../../../index.php?do=crop" title="Home" class="btn btn-primary">Home</a>');

//echo 'ok '.$ImgCatID;

echo(ImgCropFilterInfo($ImgCatID, $ImgCropFilterNow, $cr));


function ImgCropFilterInfo($ImgCatID, $ImgCropFilterNow, $cr) {

$ImgCatName = B1T2P(2, $ImgCatID);
$ImgCropFilterName = B1T5P(2, $ImgCropFilterNow);
$ImgCropFilterInfo = B1T5P(3, $ImgCropFilterNow);
//$ImgCropFilterImgCat = B1T5P(4, $ImgCropFilterNow);

/*$ImgCropName = B1T3P(2, $ImgCropID);
$ImgCropInfo = B1T3P(3, $ImgCropID);
$ImgCropStatus = B1T3P(5, $ImgCropID);
$ImgCropImgName = B1T3P(6, $ImgCropID);
$ImgCropImgW = B1T3P(7, $ImgCropID);
$ImgCropImgH = B1T3P(8, $ImgCropID);*/
//$ImgCropFilterNow = B1T3P(9, $ImgCropID);

//$db = B1T5_sel();
$db = B1T5_sel2($ImgCatID);
while ($ImgCropFilter = $db->fetchArray()) {
	if ($ImgCropFilter['B1T5P1'] == $ImgCropFilterNow) {
		$ImgCropFilterSeleOpt .= '<option value="' . $ImgCropFilter['B1T5P1'] . '" selected>' . $ImgCropFilter['B1T5P2'] . '</option>';
	} else {
		$ImgCropFilterSeleOpt .= '<option value="' . $ImgCropFilter['B1T5P1'] . '">' . $ImgCropFilter['B1T5P2'] . '</option>';
	}
}

if ($cr == 'false') {
$txt = '
<div style="width: 300px;margin: 20px auto;">
<form name="ImgCropFilterEdit" method="post" role="form">
 
  <div class="form-group">
	<input type="hidden" name="ImgCatID" value="' . $ImgCatID . '">
	<input type="hidden" name="cr" value="false">
  </div>

<div class="form-group">
	<label for="ImgCat">ImgCat</label>
	<input id="ImgCat" name="ImgCat" class="form-control" type="text" value="' . $ImgCatName . '" disabled>
</div>

<div class="form-group">
  <button name="ImgCropFilterCr" type="submit" class="btn btn-primary">Создать новый фильтр</button>
</div>

<div class="form-group">
	<label for="ImgCropFilter">ImgCropFilter</label>
	<select class="form-control" id="ImgCropFilter" name="ImgCropFilterID" onchange="this.form.submit()">
		' . $ImgCropFilterSeleOpt . '
	</select>
</div>

<div class="form-group">
	<label for="ImgCropName">ImgCropFilterName</label>
	<input id="ImgCropFilterName" name="ImgCropFilterName" class="form-control" type="text" size="40" value="' . $ImgCropFilterName . '">
</div>

<div class="form-group">
	<label for="ImgCropInfo">ImgCropFilterInfo</label>
	<input id="ImgCropFilterInfo" name="ImgCropFilterInfo" class="form-control" type="text" value="' . $ImgCropFilterInfo . '">
</div>

<div class="form-group">
  <button name="ImgCropFilterUpdate" type="submit" class="btn btn-primary">Update</button>
  <button name="ImgCropFilterDel" type="submit" class="btn btn-primary">Del</button>
</div>


</form>
</div>
';
} else {
$txt = '
<div style="width: 300px;margin: 20px auto;">
<form name="ImgCropFilterNew" method="post" role="form">
 
  <div class="form-group">
	<input type="hidden" name="ImgCatID" value="' . $ImgCatID . '">
	<input type="hidden" name="cr" value="false">
  </div>

<div class="form-group">
	<label for="ImgCat">ImgCat</label>
	<input id="ImgCat" name="ImgCat" class="form-control" type="text" value="' . $ImgCatName . '" disabled>
</div>

<div class="form-group">
  <button name="ImgCropFilterUpd" type="submit" class="btn btn-primary">Изменить существующий фильтр</button>
</div>

<div class="form-group">
	<label for="ImgCropName">ImgCropFilterName</label>
	<input id="ImgCropFilterName" name="ImgCropFilterName" class="form-control" type="text" size="40" value="">
</div>

<div class="form-group">
	<label for="ImgCropInfo">ImgCropFilterInfo</label>
	<input id="ImgCropFilterInfo" name="ImgCropFilterInfo" class="form-control" type="text" value="">
</div>

<div class="form-group">
  <button name="ImgCropFilterCreate" type="submit" class="btn btn-primary">Create</button>
</div>

</form>
</div>
';
}
return $txt;
}

require_once('footer.php');
?>
