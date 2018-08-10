<?php 
session_start();
	require_once realpath( __DIR__ . '/../../../..') . '/config.php' ;
	require_once realpath( __DIR__ . '/..') . '/header.php' ;
	require_once realpath( __DIR__ ) . '/db.php' ;

/*echo "signup -- "."<br>".
realpath(__DIR__)."<br>".
realpath(__DIR__ . '/..').'/header.php'."<br>".
realpath(__DIR__).'/db.php'."<br>".
PL_SELF_SRVNO."<br>".
URLSELF(__DIR__)."<br>";
*/

error_reporting(E_ALL); ini_set('display_errors', true);
/*session_start();
echo '<a href="?', time(), '">refresh</a>', "\n";

echo '<pre>';
echo 'session id: ', session_id(), "\n";

$sessionfile = ini_get('session.save_path') . '/' . 'sess_'.session_id();
echo 'session file: ', $sessionfile, ' ';
if ( file_exists($sessionfile) ) {
    echo 'size: ', filesize($sessionfile), "\n";
    echo '# ', file_get_contents($sessionfile), ' #';
}
else {
    echo ' does not exist';
}

var_dump($_SESSION);
echo "</pre>\n";

$_SESSION['ID'] = "112233";
$_SESSION['token'] = "mytoken";

session_write_close();
echo 'done.';
*/

/**/
session_start();
if (!isset($_SESSION['counter'])) $_SESSION['counter']=0;
echo "Вы обновили эту страницу ".$_SESSION['counter']++." раз. ";
echo "<br><a href=".$_SERVER['PHP_SELF'].">обновить</a>"; 

//$_SESSION['ID'] = "112233";
print_r($_SESSION);


	$data = $_POST;

	function captcha_show(){
		$questions = array(
			1 => '5 - 1',
			2 => '4 + 4',
			3 => '2 + 3',
			4 => '15 + 14',
			5 => '45 - 10',
			6 => '33 - 3'
		);
		$num = mt_rand( 1, count($questions) );
		$_SESSION['captcha'] = $num;
		echo $questions[$num];
	}

	//если кликнули на button
	if ( isset($data['do_signup']) )
	{
    // проверка формы на пустоту полей
		$errors = array();
		if ( trim($data['login']) == '' )
		{
			$errors[] = 'Введите логин';
		}

		if ( trim($data['email']) == '' )
		{
			$errors[] = 'Введите Email';
		}

		if ( $data['password'] == '' )
		{
			$errors[] = 'Введите пароль';
		}

		if ( $data['password_2'] != $data['password'] )
		{
			$errors[] = 'Повторный пароль введен не верно!';
		}

		//проверка на существование одинакового логина
		if ( R::count('B1T6', "B1T6P2 = ?", array($data['login'])) > 0)
		{
			$errors[] = 'Пользователь с таким логином уже существует!';
		}
    
    //проверка на существование одинакового email
		if ( R::count('B1T6', "B1T6P4 = ?", array($data['email'])) > 0)
		{
			$errors[] = 'Пользователь с таким Email уже существует!';
		}

		//проверка капчи
		$answers = array(
			1 => '4',
			2 => '8',
			3 => '5',
			4 => '29',
			5 => '35',
			6 => '30'
		);
		if ( $_SESSION['captcha'] != array_search( $data['captcha'], $answers ) )
		{
//echo $_SESSION['captcha'] .' - '. array_search( $data['captcha'], $answers );
			$errors[] = 'Ответ на вопрос указан не верно!';
			//var_dump($answers);
		}


		if ( empty($errors) )
		{
echo '_SESSION - '.$_SESSION['captcha'].' '.$data['login'].' '. $data['password'];

			//ошибок нет, теперь регистрируем
			$user = R::dispense('b1t6');
			$user->B1T6P2 = $data['login'];
			$user->B1T6P4 = $data['email'];
			$user->B1T6P3 = password_hash($data['password'], PASSWORD_DEFAULT); //пароль нельзя хранить в открытом виде, мы его шифруем при помощи функции password_hash для php > 5.6
			R::store($user);
			echo '<div style="color:dreen;">Вы успешно зарегистрированы!</div><hr>';
		}else
		{
			echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
		}

	}

?>

<form action="<?php echo URLSELF(__DIR__) . '/signup.php'; ?>" method="POST">
	<strong>Ваш логин</strong>
	<input type="text" name="login" value="<?php echo @$data['login']; ?>"><br/>

	<strong>Ваш Email</strong>
	<input type="email" name="email" value="<?php echo @$data['email']; ?>"><br/>

	<strong>Ваш пароль</strong>
	<input type="password" name="password" value="<?php echo @$data['password']; ?>"><br/>

	<strong>Повторите пароль</strong>
	<input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>"><br/>

	<strong><?php captcha_show(); echo  '_SESSION[captcha] - '.$_SESSION['captcha']; ?></strong>
	<input type="text" name="captcha" ><br/>

	<button type="submit" name="do_signup">Регистрация</button>
</form>
<?php 
echo "SESSION['captcha'] - ".$_SESSION['captcha'].'<br>';//.phpinfo();
print_r($_SESSION);
require_once( realpath( __DIR__ . '/..') . '/footer.php' ); ?>
