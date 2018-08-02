<?php

//echo __DIR__;
require_once('sqlite_btp.php');

class SQLite_Prj extends SQLite_BTP
{
//	public $prefix; 
//	public $idxB; 

	public function __construct(/*$prefix, $idxB,*/ $DBName)
	{
		parent::__construct($DBName);
//		$this->prefix = $prefix;
//		$this->idxB = $prefix;
	}

	public function vstavka()
	{
		 $sql = "INSERT INTO ImgCat (ImgCat1, Name)
			VALUES (1, 'Paul');";

		$ret = $this->exec("INSERT INTO ImgCat (ImgCat1, Name) VALUES (1, 'Paul1');");
if(!$ret) {
      echo $this->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
//		echo($this->DBPath);
	}

	public function insert($Tbl, $Ple, $Val)
	{
		$sql = "INSERT INTO ".$Tbl." (".$Ple.") VALUES (".$Val.");";

//echo($sql);
		$this->exec($sql);

	}

	public function Upd($Tbl, $PleVal, $Where = "")
	{
		if ($Where != ""){
			$Where = " WHERE ".$Where;
		}
		$sql = "UPDATE ".$Tbl." SET ".$PleVal.$Where;
//echo($sql);
		$this->exec($sql);
	}

	public function sel($Tbl, $Ple, $Where = "")
	{
		if ($Where != ""){
			$Where = " WHERE ".$Where;
		}
		$sql = "SELECT ".$Ple." FROM ".$Tbl.$Where;
//echo($sql);
		return $this->query($sql);
	}

	public function selSingle($Tbl, $ValPle, $PleID)
	{
		$sql = "SELECT " . $ValPle . " FROM " . $Tbl . " WHERE " . $PleID;
//echo($sql);
		return $this->querySingle($sql);
	}

	public function Del($Tbl, $PleVal)
	{
		$sql = "DELETE FROM ".$Tbl." WHERE ".$PleVal;

		$this->exec($sql);
	}

	public function MaxT($Tbl, $Ple)
	{
		$res = $this->sel($Tbl, 'MAX(' . $Ple . ')');

		while ($row = $res->fetchArray()) {
			$id = $row['MAX(' . $Ple . ')'];
		}
		return $id;
	}


	public function CountT($Tbl, $Where)
	{
		$res = $this->sel($Tbl, 'Count (*)', $Where);

		while ($row = $res->fetchArray()) {
			$count = $row['Count (*)'];
		}
		return $count;
	}

}
?>
