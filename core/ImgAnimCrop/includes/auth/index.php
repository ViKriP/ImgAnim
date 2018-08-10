<?php
session_start();
	require_once realpath( __DIR__ . '/../../../..') . '/config.php' ;
	require_once realpath( __DIR__ ) . '/db.php' ;
?>

<?php if ( isset ($_SESSION['logged_user']) ) : ?>
	Авторизован! <br/>
	Привет, <?php echo $_SESSION['logged_user']->B1T6P2; ?>!<br/>

	<a href="core/ImgAnimCrop/includes/auth/logout.php">Выйти</a>

<?php else : ?>
Вы не авторизованы<br/>
<a href="<?php echo URLSELF(__DIR__).'/login.php'; ?>">Авторизация</a>
<a href="<?php echo URLSELF(__DIR__).'/signup.php'; ?>">Регистрация</a>
<?php endif; ?>

