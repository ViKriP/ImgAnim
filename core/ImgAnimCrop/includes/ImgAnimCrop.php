<?php
session_start();
require_once('ImgAnimCore.php');

//testDB();

$IDImgCat = '0';
$ImgCropID = '0';

if (isset($_POST['options'])) {
	$IDImgCat = clean($_POST['options']);
$ImgCropCr = '
<form name="ImgCropFilterForm" action="core/ImgAnimCrop/includes/ImgCropFilter.php" method="post" role="form">
	<div class = "container">
	<div class = "row">
		<div class="form-group">
			<input type="hidden" name="IDImgCat" value="' . $IDImgCat . '">
		</div>
		<button type="submit" class="btn btn-primary">ImgCropFilter</button>
	</div>
	</div>
</form>

<input type="button" value="Создать ImgCrop" onclick="ToHide(\''.'ImgCropAdd'.'\');" />
<div id="ImgCropAdd" hidden>
<form name="ImgCropForm" method="post" role="form">
	<div class = "container">
	<div class = "row">
		<div class="form-group">
			<input type="hidden" name="IDImgCat" value="' . $IDImgCat . '">
		</div>
		<div class="form-group">
			<label for="ImgCropCount">Количество картинок</label>
			<input id="ImgCropCount" name="ImgCropCount" class="form-control" type="text" value="1">
		</div>
		<button name="ImgCropInsert" type="submit" class="btn btn-primary">Создать</button>
	</div>
	</div>
</form>
</div>

';
}

if (isset($_POST['ImgCropInsert'])) {

	$IDImgCat = clean($_POST['IDImgCat']);
	$ImgCropCount = clean($_POST['ImgCropCount']);
	$RecCount = B1T3_MaxID();

		if (is_numeric($ImgCropCount)) {
		for ($i = 1; $i <= $ImgCropCount; $i++) {
			$ImgCropNameAuto = 'ImgCrop' . ($RecCount+$i);

			$ValT3[2] = "'" . $ImgCropNameAuto . "'";
			$ValT3[3] = "'img'";
			$ValT3[4] = "'" . $IDImgCat . "'";
			$ValT3[5] = "'0'";
			$ValT3[6] = "''";
			$ValT3[7] = "''";
			$ValT3[8] = "''";
			$ValT3[9] = "'0'";
			$ValT3[10] = "''";

		B1T3_ins($ValT3);
		}
		}
}

if (isset($_POST['BtnImgF'])) {
	$ImgCropID = clean($_POST['BtnImgF']);

	$IDImgCat = B1T3P(4, $ImgCropID);
	$ImgName = B1T3P(6, $ImgCropID);

	$ImgPath = B1T2P(6, $IDImgCat);
	$Fimg = $ImgPath . '/' . $ImgName;
	$ImgF = $ImgName;
}

if (isset($_POST['ImgPoly'])) {
	$ImgPolyID = clean($_POST['ImgPoly']);
	$ImgCropID = B1T4P(4, $ImgPolyID);
	$IDImgCat = B1T3P(4, $ImgCropID);

}

if (isset($_POST['ImgPolyInsert'])) {

	$ImgCropID = clean($_POST['ImgCropID']);
	$ImgPolyCount = clean($_POST['ImgPolyCount']);
	$RecCount = B1T4_MaxID();

if (is_numeric($ImgPolyCount)) {
for ($i = 1; $i <= $ImgPolyCount; $i++) {
	$ImgPolyNameAuto = 'Poly' . ($RecCount+$i);

	$ValT4[2] = "'" . $ImgPolyNameAuto . "'";
	$ValT4[3] = "''";
	$ValT4[4] = "'" . $ImgCropID . "'";
	$ValT4[5] = "'0'";
	$ValT4[6] = "''";
	$ValT4[7] = "''";
	$ValT4[8] = "''";

	B1T4_ins($ValT4);
}
}
}

if (isset($_POST['ImgPolyUpdate'])) {

	$ImgPolyID = clean($_POST['ImgPolyID']);
	$ImgCropID = B1T4P(4, $ImgPolyID);

	$ValT4[2] = "'" . clean($_POST['ImgPolyName']) . "'";
	$ValT4[3] = "'" . clean($_POST['ImgPolyInfo']) . "'";
	$ValT4[4] = "'" . $ImgCropID . "'";
	$ValT4[5] = "'" . clean($_POST['ImgPolyStatus']) . "'";
	$ValT4[6] = "'" . clean($_POST['coords1']) . "'";
	$ValT4[7] = "'" . clean($_POST['ImgPolySquare']) . "'";
	$ValT4[8] = "'" . clean($_POST['ImgPolyRooms']) . "'";

	B1T4_upd($ImgPolyID, $ValT4);

	$IDImgCat = B1T3P(4, $ImgCropID);
}

if (isset($_POST['ImgPolyDel'])) {

	B1T4_del(clean($_POST['ImgPolyID']));

	$IDImgCat = clean($_POST['IDImgCat']);
	$ImgCropID = clean($_POST['ImgCropID']);
}


if ( isset ($_SESSION['logged_user']) ) {

echo '<a href="'. URLSELF(__DIR__).'/auth/logout.php'.'">ВЫХОД</a><br />';
echo hash_file('md5', 'http://objdev/Novodv1/DEV_PlanPresent/plans/DEV/out_jpg/min'.'/'.'01-min.jpg');
//echo('<br>'.date('Ymd H:i:s').'<br>');
echo(InDB($IDImgCat));
echo('
<div>
 <a href="core/ImgAnimCrop/includes/ImgCat.php"><input type="button" value="Edit ImgCat" /></a>

<form name="ImgCatForm" action="core/ImgAnimCrop/includes/ImgCat.php" method="post" role="form">
	<div class = "container">
	<div class = "row">
		<div class="form-group">
			<input type="hidden" name="ImgDir" value="' . DIRROOT . '">
		</div>
		<button type="submit" class="btn btn-primary">Edit</button>
	</div>
	</div>
</form>

'.$ImgCropCr);

//echo 'ok '.$IDImgCat;

echo '<div style="border: 1px solid #9b9bc0;background: #cdcdcd;">';
echo(ImgCropDB($IDImgCat, $ImgCropID));
echo(ImgCropInfoDB($ImgCropID));
echo '</div>';
echo(ImgPolyDB($ImgCropID, $ImgPolyID));
echo(ImgPolyInfoDB($ImgPolyID));

} else {

echo 'Вы не авторизованы<br/>
<a href="'. URLSELF(__DIR__).'/auth/login.php'.'">Авторизация</a>
<a href="'. URLSELF(__DIR__).'/auth/signup.php'.'">Регистрация</a>';
}
