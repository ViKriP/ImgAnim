<?php
require_once('ImgAnimCore.php');


function ImgAnimShow($ImgCatID){

$DirShowWeb = B1T2P(7, $ImgCatID);

if (!$DirShowWeb) {
	echo "В данный момент планировки проходят заключительный этап формирования и в ближайшее время будут предоставлены для общего обозрения.<br />\n Приносим извинения за неудобства.<br />\n";
	exit;
}

echo('<div id="ImgAnim-wrap">

<div id="mainContent" style="display: none;">
    <div id="canvasDiv"></div>
    <div class="clipParent"></div> 
</div>

<div class="imgwrap">
<h3>Укажите этаж</h3>');

echo(DIRSELF);

ImgUI($ImgCatID);

//echo($DirShowWeb);

//NodeOneXml($ObjDevInfoFPath);
//--формирование меню
//UIplans($ObjDevInfoFPath,$ObjDevPath);
echo('</div></div>');

}


function ImgUI($ImgCatID){

$pref = 'dvs-';

$ImgFiltrDb = B1T5_sel();
//$ImgCropDb = B1T3_sel();


echo '<div>';
while ($ImgFiltr = $ImgFiltrDb->fetchArray()) {

	$ImgFilterName = $ImgFiltr['B1T5P2'];
	$ImgCropDb = B1T3_selW1($ImgCatID, $ImgFiltr['B1T5P1']);
	$DirShowWeb = B1T2P(7, $ImgCatID);

	$i = 1;
$txtHtml = '<div class="imgcat"><p>'.$ImgFilterName.'</p>
<select id="ImgFiltr'.$ImgFiltr['B1T5P1'].'" size="1" class="pagin-commerce" onchange="ImgFiltr(this.id)"><option value="0"></option>';

	while ($ImgCrop = $ImgCropDb->fetchArray()) {
		$ImgCropID = $ImgCrop['B1T3P1'];
		$ImgCropW = $ImgCrop['B1T3P7'];
		$ImgCropH = $ImgCrop['B1T3P8'];
		$ImgCropImgName = $ImgCrop['B1T3P6'];
		$ImgCropName = $ImgCrop['B1T3P2'];

$txtSvg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 '.$ImgCropW.' '.$ImgCropH.'">
	<g id="'.$pref.'cat'.$ImgCatID.'-img'.$ImgCropID.'-g'.$i.'" fill="#c5d8e2" stroke="black">
		<image id="'.$pref.'cat'.$ImgCatID.'-img'.$ImgCropID.'-i'.$i.'" xlink:href="'.$DirShowWeb.'/'.$ImgCropImgName.'" x="0" y="0" width="'.$ImgCropW.'" height="'.$ImgCropH.'"/>';


		$ImgPolyDB = B1T4_sel2($ImgCropID);
		while ($ImgPoly = $ImgPolyDB->fetchArray()) {

			$ImgPolyID = $ImgPoly['B1T4P1'];
			//$ImgPolyPoints = $ImgPoly['B1T4P6'];
			$ImgPolyPointsPars = ImgPointsPars($ImgPoly['B1T4P6']);

			$txtSvg .='
		<polygon id="'.$pref.'cat'.$ImgCatID.'-img'.$ImgCropID.'-poly'.$ImgPolyID.'" class="kv" points="'.$ImgPolyPointsPars.'" fill="none" stroke="purple" stroke-width="1"/>';
		}

$txtSvg .='	</g>
</svg>
';
		$txtHtml .= '<option value="img'. $ImgCropID . '">'. $ImgCropName. '</option>';

		//$NadZkEt[$valNumb]='<option value="img'. $i . '">'. $i1. ' этаж</option>';	
		$EtDiv[]= '<div id="img' . $ImgCropID . '" class="imgfull">' . $txtSvg . '</div>';
		$i++;

	}
$txtHtml .= '</select></div>';
echo $txtHtml;
}

echo('</div>');

//<!-- etag_div -->
if(count($EtDiv)!=0){
ksort($EtDiv);
//crop img
echo('<div id="ImgCrop"></div>');
//full img
echo('<div id="page-navigator">');
  foreach($EtDiv as $value)
  {
     echo "$value";
  }
echo('</div>');
} 

}
