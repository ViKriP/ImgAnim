<?php 
session_start();
	require_once realpath( __DIR__ ) . '/db.php' ;
	unset($_SESSION['logged_user']);
	//header('Location: '.realpath( __DIR__ . '/..') . '/ImgAnimCrop.php');
	$pth = PW_HOSTNAME.URLSELF(realpath( __DIR__ . '/../../../..')) . '/index.php?do=crop';
	echo '<div style="color:red;">Вы успешно вышли!<br/> Можете перейти на <a href="'.$pth.'">главную</a> страницу.</div><hr>';

?>
