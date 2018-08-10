<?php 
/*echo "ok1 -- "."<br>".
dirname($_SERVER["PHP_SELF"])."<br>".
__DIR__."<br>".
DIRDB1DB."<br>".
realpath(__DIR__ . '/..')."<br>".
dirname( __FILE__, 5 )."<br>";
*/
	require realpath(__DIR__).'/libs/rb.php';
	require_once realpath( __DIR__ . '/../../../..') . '/config.php' ;
//R::setup( 'mysql:host=127.0.0.1;dbname=redbeen','root', '' ); 

R::setup('sqlite:'.DIRDB1DB);

if ( !R::testconnection() )
{
		exit ('Нет соединения с базой данных');
}

session_start();

