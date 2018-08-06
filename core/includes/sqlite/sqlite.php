<?php

class SQLite extends SQLite3 
{
	public $DB;
	public $DBPath;

	public function __construct($DBName)
	{
//		parent::__construct();
//		$this->open($DBName);
		$this->DBPath = $DBName;

//$this->DB = new SQLite3($DBName);
    if(!file_exists($DBName)){
	echo "База не подключена [".$DBName."] ";// . $this->lastErrorMsg();

/*        $db = new SQLite3('mydb.db');
        $sql="CREATE TABLE msages(
            id INTEGER PRIMARY KEY,
            fname TEXT,
            email TEXT,
            msage TEXT,
            datetime INTEGER,  
        )";
        $db->query($sql); */
    }else{
//        $this->DB = new SQLite3($DBName);
	$this->open($DBName);
//	echo("База подключена");
    }


	}

	function __destruct() {
//		unset($this->DB);
//		$this->DB->close();
//		$this->close();
//		echo("Пока");
	}

	public function verSQLite3()
	{
		//SQLite3::version()[versionString]
		//return $this->version()[versionString];
	}

	public function openMy()
	{


//    if(!file_exists($this->DBPath)){
//	echo "База не подключена";// . $this->lastErrorMsg();

/*        $db = new SQLite3('mydb.db');
        $sql="CREATE TABLE msages(
            id INTEGER PRIMARY KEY,
            fname TEXT,
            email TEXT,
            msage TEXT,
            datetime INTEGER,  
        )";
        $db->query($sql); */
/*    }else{
       $DB = new SQLite3($this->DBPath);
	echo "База подключена";// . $this->lastErrorMsg();
    }
*/
	}
}
?>
