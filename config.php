<?php
define("DIRSYS", __DIR__);
define("DIRDB1DB", DIRSYS.'/imganim.db');
define("DIRDB1", DIRSYS.'/core/includes/db1.php');

//define("DIRSELF", $_SERVER['PHP_SELF']); 
//define("DIRSELF", dirname($_SERVER['PHP_SELF']));
define("DIRSELF", str_replace( $_SERVER['DOCUMENT_ROOT'], '', DIRSYS ));

