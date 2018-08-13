<?php
include_once('../../../config.php');
require_once(DIRDB1);


function testCore(){
echo("TestCore OK");
}

function clean($value = "") {
	$value = trim($value);
	$value = stripslashes($value);
	$value = strip_tags($value);
	$value = htmlspecialchars($value);
    
	return $value;
}

function InDB($IDImgCat){

$db = B1T2_sel2();

$txt = '<form name="ImgCatForm" method="post"><div class="btn-group btn-group-toggle" data-toggle="buttons">';

while ($row = $db->fetchArray()) {
if($IDImgCat == $row['B1T2P1']){
$txt .='
  <label class="btn btn-secondary active">
    <input type="radio" name="options" id="option'.$i.'" value="' . $row['B1T2P1'] . '" autocomplete="off" onchange="this.form.submit()" checked> ' . $row['B1T2P2'] . '
  </label>';
} else {
$txt .='
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="option'.$i.'" value="' . $row['B1T2P1'] . '" autocomplete="off" onchange="this.form.submit()">' . $row['B1T2P2'] . '
  </label>';
}
}

$txt .= '</div></form>';

return $txt;
}

function ImgCropDBIns($IDImgCat, $ImgDir) {

foreach (glob($ImgDir."/*.jpg") as $filename) {
$FName = basename($filename);
	if (B1T3_selW2($IDImgCat, $FName) == '') {
//echo('ImgCropDBIns 2 '.basename($filename));

	$ImgCropSize = getimagesize ($filename);

		$ValT3[2] = "'" . $FName . "'";
		$ValT3[3] = "'img'";
		$ValT3[4] = "'" . $IDImgCat . "'";
		$ValT3[5] = "'0'";
		$ValT3[6] = "'" . basename($filename) . "'";
		$ValT3[7] = "'" . $ImgCropSize[0] . "'";
		$ValT3[8] = "'" . $ImgCropSize[1] . "'";
		$ValT3[9] = "'0'";
		$ValT3[10] = "'" . hash_file($ImgDir . '/' . basename($filename)) . "'";

echo($filename.'<br />'.$ImgDir . '/' . basename($filename));

	B1T3_ins($ValT3);
	}
}
}

function ImgCropDB($IDImgCat, $ImgCropID){

	//$IDImgCat = clean($_POST['options']);
	//?? $ImgPathLocal = B1T2P3_id($IDImgCat);

	$db = B1T3_IDImgCat($IDImgCat);

	$txt .='<form name="ImgCropForm" method="post">';
	while ($ImgCrop = $db->fetchArray()) {

		if($ImgCropID == $ImgCrop['B1T3P1']){
			$txt .='<button id="' . $ImgCrop['B1T3P6'] ./* '_' . $ImgCrop['B1T3P1'] .*/ '" class="btnKv ImgCrop active '.B1T3P5_stat($ImgCrop['B1T3P1']).'" type="submit" name="BtnImgF" onclick=img_etag(this.id) value="' . $ImgCrop['B1T3P1'] . '">' . $ImgCrop['B1T3P2'] . '</button>'; 
		} else {
			$txt .='<button id="' . $ImgCrop['B1T3P6'] ./* '_' . $ImgCrop['B1T3P1'] .*/ '" class="btnKv ImgCrop '.B1T3P5_stat($ImgCrop['B1T3P1']).'" type="submit" name="BtnImgF" onclick=img_etag(this.id) value="' . $ImgCrop['B1T3P1'] . '">' . $ImgCrop['B1T3P2'] . '</button>'; 
		}
	}

	$txt .='</form>';

return $txt;
}

function ImgCropInfoDB($ImgCropID){
if($ImgCropID > 0) {
	$ImgCatID = B1T3P(4, $ImgCropID);
	$Name = B1T3P(2, $ImgCropID);
	$ImgName = B1T3P(6, $ImgCropID);
	$Inf = B1T3P(3, $ImgCropID);
	$Status = B1T3P(5, $ImgCropID);
$txt = '<div><p><b>' . $Name . '</b>&nbsp;<b>' . $ImgName . '</b>&nbsp;<b>' . $Status . '</b>&nbsp;<b>' . $Inf . '</b>
</p></div>

<form name="ImgPolyForm" action="core/ImgAnimCrop/includes/ImgCrop.php" method="post" role="form">
  <div class="form-group">
	<input type="hidden" name="ImgCatID" value="' . $ImgCatID . '">
	<input type="hidden" name="ImgCropID" value="' . $ImgCropID . '">
  </div>

  <button name="ImgCropEdit" type="submit" class="btn btn-primary">Edit ImgCrop</button>

</form>

<div>
	<input type="button" value="Создать ImgPoly" onclick="ToHide(\''.'ImgPolyAdd'.'\');" />
	<div id="ImgPolyAdd" hidden>
		<form name="ImgPolyForm" method="post" role="form">
<div class = "container">
<div class = "row">

<div class="form-group">
	<input type="hidden" name="ImgCropID" value="' . $ImgCropID . '">
</div>

<div class="form-group">
	<label for="ImgPolyCount">Количество полигонов</label>
	<input id="ImgPolyCount" name="ImgPolyCount" class="form-control" type="text" value="1">
</div>

<button name="ImgPolyInsert" type="submit" class="btn btn-primary">Создать</button>

</div>
</div>
			
		</form>
	</div>
</div>
';

return $txt;
}
}

function ImgPolyDB($ImgCropID, $ImgPolyID){

	//if ($ImgPolyID > 0) {

	$db = B1T4_sel2($ImgCropID);
//var_dump($db);
	$txt .='<form name="ImgPolyForm" method="post">';
	while ($ImgPoly = $db->fetchArray()) {

		if($ImgPolyID == $ImgPoly['B1T4P1']){
			$txt .='<button id="poly' . $ImgPoly['B1T4P1'] ./* '_' . $ImgCrop['B1T3P1'] .*/ '" class="btnKv ImgPoly active" type="submit" name="ImgPoly" onclick=img_etag(this.id) value="' . $ImgPoly['B1T4P1'] . '">' . $ImgPoly['B1T4P2'] . '</button>'; 
		} else {
			$txt .='<button id="poly' . $ImgPoly['B1T3P1'] ./* '_' . $ImgCrop['B1T3P1'] .*/ '" class="btnKv ImgPoly" type="submit" name="ImgPoly" onclick=img_etag(this.id) value="' . $ImgPoly['B1T4P1'] . '">' . $ImgPoly['B1T4P2'] . '</button>'; 
		}
	}

	$txt .='</form>';

	return $txt;

	//}
}

function ImgPolyInfoDB($ImgPolyID){
if($ImgPolyID > 0) {
	$Name = B1T4P(2, $ImgPolyID);
	$Info = B1T4P(3, $ImgPolyID);
	$Status = B1T4P(5, $ImgPolyID);
	$Points = B1T4P(6, $ImgPolyID);
	$Square = B1T4P(7, $ImgPolyID);
	$Rooms = B1T4P(8, $ImgPolyID);

	$ImgCropID = B1T4P(4, $ImgPolyID);
	$IDImgCat = B1T3P(4, $ImgCropID);
	
	$ImgCropPath = B1T2P(6, $IDImgCat) . '/' . B1T3P(6, $ImgCropID);

$txt = '<form role="form" name="ImgPolyInfoForm" method="post">
<div class = "container">
<div class = "row">

<div class="form-group">
	<input type="hidden" name="IDImgCat" value="' . $IDImgCat . '">
	<input type="hidden" name="ImgCropID" value="' . $ImgCropID . '">
	<input type="hidden" name="ImgPolyID" value="' . $ImgPolyID . '">
</div>

<div class="form-group">
	<label for="ImgPolyName">Название полигона</label>
	<input id="ImgPolyName" name="ImgPolyName" class="form-control" type="text" value="' . $Name . '">
</div>

<div class="form-group">
	<label for="ImgPolyRooms">Количество комнат</label>
	<input id="ImgPolyRooms" name="ImgPolyRooms" class="form-control" type="text" value="' . $Rooms . '">
</div>

<div class="form-group">
	<label for="ImgPolySquare">Общая площадь</label>
	<input id="ImgPolySquare" name="ImgPolySquare" class="form-control" type="text" value="' . $Square . '">
</div>

<div class="form-group">
	<label for="ImgPolyStatus">Статус</label>
	<input id="ImgPolyStatus" name="ImgPolyStatus" class="form-control" type="text" value="' . $Status . '">
</div>

<div class="form-group">
	<label for="ImgPolyInfo">Описание</label>
	<input id="ImgPolyInfo" name="ImgPolyInfo" class="form-control" type="text" value="' . $Info . '">
</div>

<!-- <div class="form-group">
	<label for="ImgPolyPointsEdit">Points полигона</label>
	<input id="ImgPolyPointsEdit" name="ImgPolyPointsEdit" class="form-control" type="text" value="' . $Points . '">
	<input type="button" value="OK" onclick=PointsToSVG()>
</div> -->

<div class="form-group" style="margin: 35px;">
	<input name="ImgPolyUpdate" type="submit" value="Обновить" />&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="ImgPolyDel" type="submit" value="Удалить" />
</div>

<div>
<!-- Выделение объекта -->
    <div id="main" class="container form-group"  style="float: left;width: 100%;">
    <!-- <h1>AnimPlans - ' . B1T3P(6, $ImgCropID) . '</h1> -->
    <form method="post"> 
    <div class="row">
      <div class="span6">
      <!-- <h2> Image 1 </h2> -->
	<label for="ImgPolyPoints">Points полигона</label>
      <textarea rows="2" cols="40" name="coords1" class="canvas-area input-xxlarge form-control"  
        placeholder="Shape Coordinates" id="ImgPolyPoints"
        data-image-url="' . $ImgCropPath . '" style="width: 400px">'.$Points.'</textarea>
      </div>
    </div>
    </form>
    </div>
</div>

</div>
</div>


</form>';

return $txt;
}
}

?>
