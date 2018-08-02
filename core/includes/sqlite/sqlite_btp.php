<?php

require_once('sqlite.php');

class SQLite_BTP extends SQLite
{

	public function __construct($DBName)
	{
		parent::__construct($DBName);
	}
}
?>
