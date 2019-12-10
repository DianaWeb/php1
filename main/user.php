<?
function index(){

	if (! empty($_POST)){
		isUorToken();
		$login = clearStr($_POST['login']);
		$sql = "SELECT login, password, name, typeUser FROM users WHERE login = '$login'";
		$res = mysqli_query(connect(), $sql);
		$row = mysqli_fetch_assoc($res);
		if (empty($row)){
			$_SESSION['msg'] = 'Не верен логин или пароль';
			header('Location: ?page=user');
			exit;
		}
		if ($row['password'] == md5($_POST['password'])) {
			$_SESSION['user'] = [
				'name' => $row['name'],
				'typeUser' => $row['typeUser'],
				'login' => $row['login'],
				'password' => $_POST['password'],
			];

			if ($row['typeUser'] == '1'){
				$_SESSION['isAdmin'] = IS_ADMIN;

			} elseif ($row['typeUser'] == '0') {
                $_SESSION['isUser'] = IS_USER;
            }
		    } else {
                $_SESSION['msg'] = 'Не верен логин или пароль';
    //			header('Location: ?page=user');
    //			exit;
        }
	}

    if (! empty($_SESSION['isUser']) && $_SESSION['isUser'] == IS_USER){
        $content =<<<php
		<h3>Добро пожаловать {$_SESSION['user']['name']}!</h3>
		<h3>Ваш логин: {$_SESSION['user']['login']}</h3>
		<h3>Ваш пароль: {$_SESSION['user']['password']}</h3>
		<a href="?page=exit">Выход</a>		
php;
    }

    elseif (! empty($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == IS_ADMIN){
		$content = <<<php
		<h3>Добро пожаловать {$_SESSION['user']['name']}!</h3>
		<h3>Ваш логин: {$_SESSION['user']['login']}</h3>
		<h3>Ваш пароль: {$_SESSION['user']['password']}</h3>
		<a href="?page=zakazi">Показать заказы</a><br>
		<a href="?page=addProduct">Добавить товар</a><br>
		<a href="?page=exit">Выход</a>		
php;
	} else {
		$token = newToken();
        $content = <<<php
	<form action="" method="post">
		$token
		<input type="text" name="login" placeholder="login">
		<input type="password" name="password" placeholder="password">
		<input type="submit">
	</form>
php;

	}
	return $content;
}

function addUser() {
	isAdmin();
}