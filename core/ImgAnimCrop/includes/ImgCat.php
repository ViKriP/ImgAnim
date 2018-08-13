<?php
$Title = 'ImgCat';
require_once('header.php');
require_once('ImgAnimCore.php');

$ImgDirSys = DIRSYS;
//$DirSelf = DIRSELF;

$IDImgCat = 0;

if (isset($_POST['options'])) {
	$IDImgCat = clean($_POST['options']);
}

if (isset($_POST['ImgCatInsert'])) {

$ImgDir = clean($_POST['ImgDir']);

	$ValT2[2] = "'" . clean($_POST['ImgCatName']) . "'";
	$ValT2[3] = "'" . $ImgDir . "'";
	$ValT2[4] = clean($_POST['ImgCatStatus']);
	$ValT2[5] = "'" . clean($_POST['ImgCatInf']) . "'";
	$ValT2[6] = "'" . clean($_POST['DirCropWeb']) . "'";
	$ValT2[7] = "'" . clean($_POST['DirShowWeb']) . "'";

B1T2_ins($ValT2);

ImgCropDBIns($IDImgCat, $ImgDir);

	$IDImgCat = 0;
}

if (isset($_POST['ImgCatUpdate'])) {

	$IDImgCat = clean($_POST['IDImgCat']);
	$ImgDir = clean($_POST['ImgDir']);

	$ValT2[2] = "'" . clean($_POST['ImgCatName']) . "'";
	$ValT2[3] = "'" . $ImgDir . "'";
	$ValT2[4] = "'" . clean($_POST['ImgCatStatus']) . "'";
	$ValT2[5] = "'" . clean($_POST['ImgCatInf']) . "'";
	$ValT2[6] = "'" . clean($_POST['DirCropWeb']) . "'";
	$ValT2[7] = "'" . clean($_POST['DirShowWeb']) . "'";

	B1T2_upd($IDImgCat, $ValT2);

ImgCropDBIns($IDImgCat, $ImgDir);

	$IDImgCat = 0;
}

if (isset($_POST['ImgCatDel'])) {
	$IDImgCat = clean($_POST['IDImgCat']);

	B1T2T3T4_del($IDImgCat);

	$IDImgCat = 0;
}

echo(InDB($IDImgCat));
echo('
<a href="../../../index.php?do=crop" title="Home" class="btn btn-primary">Home</a>
<a href="#" title="Создать" class="btn btn-primary" onclick="location.href=location.href;">Создать</a>
');
echo(ImgCatInfo($IDImgCat));



function ImgCatInfo($IDImgCat) {
$checked1 = '';
$checked2 = 'checked';
$active1 = '';
$active2 = 'active';

if ($IDImgCat > 0) {

$db = B1T2_sel($IDImgCat);

$checked1 = '';
$checked2 = '';
$active1 = '';
$active2 = '';
	while ($row = $db->fetchArray()) {

		$ImgCatName = $row['B1T2P2'];
		$ImgDir = $row['B1T2P3'];
		$ImgCatStatus = $row['B1T2P4'];
		$ImgCatInf = $row['B1T2P5'];
		$DirCropWeb = $row['B1T2P6'];
		$DirShowWeb = $row['B1T2P7'];

		if ($ImgCatStatus == 0) {
			$checked2 = 'checked';
			$active2 = 'active';
		} else {
			$checked1 = 'checked';
			$active1 = 'active';
		}
	}
}

$txt = '
<div style="width: 300px;margin: 20px auto;">
<form name="ImgCatEdit" method="post" role="form">
 
  <div class="form-group">
<!--	<input type="hidden" name="ImgCatID" value="' . $ImgCatID . '">
	<input type="hidden" name="ImgCropID" value="' . $ImgCropID . '"> -->
	<input type="hidden" name="IDImgCat" value="' . $IDImgCat . '">
  </div>

<div class="form-group">
	<label for="IDImgCatName">Название категории</label>
	<input id="IDImgCatName" name="ImgCatName" class="form-control" type="text" value="' . $ImgCatName . '">
</div>


<div class="form-group">
	<label for="IDImgDir">Лок Директория изображений</label>
	<label for="IDImgDir" class="hint">'.DIRSYS.'</label>
	<input id="IDImgDir" name="ImgDir" class="form-control" type="text" value="' . $ImgDir . '">
</div>

<div class="form-group">
	<label for="IDDirCropWeb">Crop Web Директория изображений</label>
	<input id="IDDirCropWeb" name="DirCropWeb" class="form-control" type="text" value="' . $DirCropWeb . '">
</div>

<div class="form-group">
	<label for="IDDirShowWeb">Tmp Web Директория изображений</label>
	<label for="IDDirShowWeb" class="hint">'.PW_IMG.'/'.$IDImgCat.'/'.DN_TMP.'</label>
	<input id="IDDirShowWeb" name="DirShowWeb" class="form-control" type="text" value="' . $DirShowWeb . '">
</div>

<div class="form-group">
	<label>ImgCat</label>

<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary '.$active1.'">
    <input type="radio" name="ImgCatStatus" id="IDImgCatStatus1" autocomplete="off" value="1" ' . $checked1 . '> Вкл
  </label>
  <label class="btn btn-secondary '.$active2.'">
    <input type="radio" name="ImgCatStatus" id="IDImgCatStatus2" autocomplete="off" value="0" ' . $checked2 . '> Выкл
  </label>
</div>

</div>

<div class="form-group">
	<label for="ImgCatInf">Описание</label>
	<textarea id="ImgCatInf" rows="2" cols="30" name="ImgCatInf">' . $ImgCatInf . '</textarea></p>
</div>';

if ($IDImgCat != 0) {
	$txt .=	'
		<input name="ImgCatUpdate" type="submit" value="Обновить" />&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="ImgCatDel" type="submit" value="Удалить" />';
	} else {
	$txt .=	'
		<input name="ImgCatInsert" type="submit" value="Сохранить" />';
}

$txt .=	'</form></div>';

return $txt;
}
 
/*echo(//__DIR__.'<br>'.
//dirname($_SERVER['PHP_SELF']).'<br>'.
DIRSELF.'<br>'
//DIRSYS
);*/
require_once('footer.php');
?>
