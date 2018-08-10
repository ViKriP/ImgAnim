<?php 
ini_set('session.use_only_cookies', 0);
session_start();
	require_once realpath( __DIR__ . '/../../../..') . '/config.php' ;
	require_once realpath( __DIR__ ) . '/db.php' ;

	$data = $_POST;
	if ( isset($data['do_login']) )
	{
		$user = R::findOne('b1t6', 'B1T6P2 = ?', array($data['login']));
		if ( $user )
		{
			//логин существует
			if ( password_verify($data['password'], $user->B1T6P3) )
			{
				//если пароль совпадает, то нужно авторизовать пользователя
				$_SESSION['logged_user'] = $user;
				
				$pth = PW_HOSTNAME.URLSELF(realpath( __DIR__ . '/../../../..')) . '/index.php?do=crop';
				echo '<div style="color:green;">Вы авторизованы!<br/> Можете перейти на <a href="'.$pth.'">главную</a> страницу.</div><hr>';
 				//header("Location: http://scripttest.my/ImgAnim/WEB_PROG/verDEV/DEV/core/ImgAnimCrop/includes/ImgAnimCrop.php?".session_name()."=".session_id());
				exit();
			}else
			{
				$errors[] = 'Неверно введен пароль!';
			}

		}else
		{
			$errors[] = 'Пользователь с таким логином не найден!';
		}
		
		if ( ! empty($errors) )
		{
			//выводим ошибки авторизации
			echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
		}

	}

?>


<form action="login.php" method="POST">
	<strong>Логин</strong>
	<input type="text" name="login" value="<?php echo @$data['login']; ?>"><br/>

	<strong>Пароль</strong>
	<input type="password" name="password" value="<?php echo @$data['password']; ?>"><br/>

	<button type="submit" name="do_login">Войти</button>
</form>
