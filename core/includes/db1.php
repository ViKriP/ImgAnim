<?php
require_once('sqlite/sqlite_prj.php');
include('../../config.php');
require_once(DIRDB1);


function testDB(){
 echo("TestDB1 OK<br>".B1T2P(2,110)."<br>");
}

//-------
//--T2---

function B1T2_ins($Val)
{
$db = new SQLite_prj(DIRDB1DB);
	$Tbl = 'B1T2'; 
	$Ple = 'B1T2P2, B1T2P3, B1T2P4, B1T2P5, B1T2P6, B1T2P7';

	$db->Insert($Tbl, $Ple, $Val[2] . "," . $Val[3] . "," . $Val[4] . "," . 
				  $Val[5] . "," . $Val[6] . "," . $Val[7]);

	return $db->MaxT($Tbl, 'B1T2P1');

$db->Close();
unset($db);
}

function B1T2_upd($B1T2P1, $Val) {
$db = new SQLite_prj(DIRDB1DB);

	$db->Upd("B1T2", "B1T2P2 = " . $Val[2] . ",
				B1T2P3 = " . $Val[3] . ",
				B1T2P4 = " . $Val[4] . ",
				B1T2P5 = " . $Val[5] . ",
				B1T2P6 = " . $Val[6] . ",
				B1T2P7 = " . $Val[7], "B1T2P1 = " . $B1T2P1);
$db->Close();
unset($db);
}

function B1T2_del($B1T2P1) {
$db = new SQLite_prj(DIRDB1DB);

	$db->Del("B1T2", "B1T2P1 = " . $B1T2P1);

$db->Close();
unset($db);
}

function B1T2_sel($B1T2P1) {
$db = new SQLite_prj(DIRDB1DB);
		
	return $db->sel("B1T2", "*", "B1T2P1 = ".$B1T2P1);

$db->Close();
unset($db);
}

function B1T2_sel2() {
$db = new SQLite_prj(DIRDB1DB);
		
	return $db->sel("B1T2", "*");

$db->Close();
unset($db);
}

function B1T2P($P, $ValP1) {
$db = new SQLite_prj(DIRDB1DB);

$Tbl = "B1T2";
$TblP = "B1T2P";
$PleID = "B1T2P1";

switch ($P) {
    case 2:
        $Ple = $TblP . $P;
        break;
    case 3:
        $Ple = $TblP . $P;
        break;
    case 4:
        $Ple = $TblP . $P;
        break;
    case 5:
        $Ple = $TblP . $P;
        break;
    case 6:
        $Ple = $TblP . $P;
        break;
    case 7:
        $Ple = $TblP . $P;
        break;
    default:
       return false;
	exit(1);
}

	return $db->selSingle($Tbl, $Ple, $PleID . " = " . $ValP1);

$db->Close();
unset($db);
}


//-------
//--T3---

function B1T3_MaxID() {
$db = new SQLite_prj(DIRDB1DB);

	return $db->MaxT('B1T3', 'B1T3P1');

$db->Close();
unset($db);
}

function B1T3_ins($ValArr)
{
$db = new SQLite_prj(DIRDB1DB);
	$Tbl = 'B1T3'; 

$count = count($ValArr);
foreach ($ValArr as $key => $val) {
	if (--$count == 0) {
		$Ple .= "B1T3P" . $key;
		$PleVal .= $val;
	} else {
		$Ple .= "B1T3P" . $key . ",";
		$PleVal .= $val . ",";
	}
}

	$db->Insert($Tbl, $Ple, $PleVal);

	return $db->MaxT($Tbl, 'B1T3P1');

$db->Close();
unset($db);
}

function B1T3_upd($B1T3P1, $ValArr) {
$db = new SQLite_prj(DIRDB1DB);

$count = count($ValArr);
foreach ($ValArr as $key => $val) {
	if (--$count == 0) {
		$rez .= "B1T3P" . $key . "=" . $val;
	} else {
		$rez .= "B1T3P" . $key . "=" . $val . ",";
	}
}

	$db->Upd("B1T3", $rez, "B1T3P1 = " . $B1T3P1);

$db->Close();
unset($db);
}

function B1T3_del($B1T3P1) {
$db = new SQLite_prj(DIRDB1DB);

	$db->Del("B1T3", "B1T3P1 = " . $B1T3P1);

$db->Close();
unset($db);
}

function B1T3_selW($W) {
$db = new SQLite_prj(DIRDB1DB);

	return $db->sel("B1T3", "*", $W);

$db->Close();
unset($db);
}

function B1T3_selW1($ImgCatID, $ImgFilterID) {
	return B1T3_selW("B1T3P4 = '".$ImgCatID."' and B1T3P9 = '".$ImgFilterID."' and B1T3P5 = '1'");
}

function B1T3_selW2($ImgCatID, $ImgName) {
$db = new SQLite_prj(DIRDB1DB);

	return $db->selSingle("B1T3", "B1T3P2", "B1T3P4 = '".$ImgCatID."' and B1T3P6 = '".$ImgName."'");

$db->Close();
unset($db);
}

function B1T3_IDImgCat($B1T3P4) {
$db = new SQLite_prj(DIRDB1DB);

	return $db->sel("B1T3", "*", "B1T3P4 = " . $B1T3P4);

$db->Close();
unset($db);
}

function B1T3P($P, $P1) {
$db = new SQLite_prj(DIRDB1DB);

$Tbl = "B1T3";
$TblP = "B1T3P";
$PleID = "B1T3P1";

switch ($P) {
    case 2:
        $Ple = $TblP . $P;
        break;
    case 3:
        $Ple = $TblP . $P;
        break;
    case 4:
        $Ple = $TblP . $P;
        break;
    case 5:
        $Ple = $TblP . $P;
        break;
    case 6:
        $Ple = $TblP . $P;
        break;
    case 7:
        $Ple = $TblP . $P;
        break;
    case 8:
        $Ple = $TblP . $P;
        break;
    case 9:
        $Ple = $TblP . $P;
        break;
    case 10:
        $Ple = $TblP . $P;
        break;
    case 11:
        $Ple = $TblP . $P;
        break;
    default:
       return false;
	exit(1);
}

	return $db->selSingle($Tbl, $Ple, $PleID . " = " . $P1);

$db->Close();
unset($db);
}

function B1T3P10_err($P1) {
	if (B1T3P(10, $P1) == '') {
		return 'err';
	}
}


//-------
//--T4---

function B1T4_MaxID() {
$db = new SQLite_prj(DIRDB1DB);

	return $db->MaxT('B1T4', 'B1T4P1');

$db->Close();
unset($db);
}

function B1T4_ins($Val) {
$db = new SQLite_prj(DIRDB1DB);
	$Tbl = 'B1T4'; 
	$Ple = 'B1T4P2, B1T4P3, B1T4P4, B1T4P5, B1T4P6, B1T4P7, B1T4P8';

	$db->Insert($Tbl, $Ple, $Val[2] . "," . 
				$Val[3] . "," . 
				$Val[4] . "," . 
				$Val[5] . "," . 
				$Val[6] . "," . 
				$Val[7] . "," . 
				$Val[8]);

	return $db->MaxT($Tbl, 'B1T4P1');

$db->Close();
unset($db);
}

// переписан с UpdT2_id
function B1T4_upd($B1T4P1, $Val) {
$db = new SQLite_prj(DIRDB1DB);

	$db->Upd("B1T4", "B1T4P2 = " . $Val[2] . ",
				B1T4P3 = " . $Val[3] . ",
				B1T4P4 = " . $Val[4] . ",
				B1T4P5 = " . $Val[5] . ",
				B1T4P6 = " . $Val[6] . ",
				B1T4P7 = " . $Val[7] . ",
				B1T4P8 = " . $Val[8], "B1T4P1 = " . $B1T4P1);
$db->Close();
unset($db);
}

function B1T4_del($B1T4P1) {
$db = new SQLite_prj(DIRDB1DB);

	$db->Del("B1T4", "B1T4P1 = " . $B1T4P1);

$db->Close();
unset($db);
}

function B1T4_del2($B1T4P4) {
$db = new SQLite_prj(DIRDB1DB);

	$db->Del("B1T4", "B1T4P4 = " . $B1T4P4);

$db->Close();
unset($db);
}


//---------------

function B1T4_sel($B1T4P1) {
$db = new SQLite_prj(DIRDB1DB);

	return $db->sel("B1T4", "*", "B1T4P1 = " . $B1T3P1);

$db->Close();
unset($db);
}

function B1T4_sel2($B1T4P4) {
$db = new SQLite_prj(DIRDB1DB);

	return $db->sel("B1T4", "*", "B1T4P4 = " . $B1T4P4);

$db->Close();
unset($db);
}



function B1T4P($P, $P1) {
$db = new SQLite_prj(DIRDB1DB);

$Tbl = "B1T4";
$TblP = "B1T4P";
$PleID = "B1T4P1";

switch ($P) {
    case 2:
        $Ple = $TblP . $P;
        break;
    case 3:
        $Ple = $TblP . $P;
        break;
    case 4:
        $Ple = $TblP . $P;
        break;
    case 5:
        $Ple = $TblP . $P;
        break;
    case 6:
        $Ple = $TblP . $P;
        break;
    case 7:
        $Ple = $TblP . $P;
        break;
    case 8:
        $Ple = $TblP . $P;
        break;
    default:
       return false;
	exit(1);
}

	return $db->selSingle($Tbl, $Ple, $PleID . " = " . $P1);

$db->Close();
unset($db);
}

function B1T4P4_Count($B1T4P4) {
$db = new SQLite_prj(DIRDB1DB);

	return $db->CountT("B1T4", "B1T4P4 = " . $B1T4P4);

$db->Close();
unset($db);
}


//--------
//---T5---

function B1T5_sel() {
$db = new SQLite_prj(DIRDB1DB);
		
	return $db->sel("B1T5", "*");

$db->Close();
unset($db);
}

//---------
//--JOIN---


function B1T2T3T4_del($B1T2P1) {
$DB = new SQLite_prj(DIRDB1DB);

$sql ="
DELETE FROM B1T4 WHERE B1T4P1 IN 
(SELECT B1T4.B1T4P1 FROM B1T4 
LEFT JOIN B1T3 ON B1T3.B1T3P1 = B1T4.B1T4P4 WHERE B1T3.B1T3P4 = " . $B1T2P1 . ");

DELETE FROM B1T3 WHERE B1T3P1 IN 
(SELECT B1T3.B1T3P1 FROM B1T3 
LEFT JOIN B1T2 ON B1T2.B1T2P1 = B1T3.B1T3P4 WHERE B1T2.B1T2P1 = " . $B1T2P1 . ");

DELETE FROM B1T2 WHERE B1T2P1 = " . $B1T2P1;

	$DB->exec($sql);

$DB->Close();
unset($DB);
}

?>
