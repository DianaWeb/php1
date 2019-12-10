<?
	function index(){
		if (empty($_SESSION['goods'])){
			return 'Нет товаров в корзине';
		}

		$inSql = implode(',', array_keys($_SESSION['goods']));			
		$sql = "SELECT id, name, info, price FROM goods WHERE id IN ($inSql)";
		$res = mysqli_query(connect(), $sql);
		
		$zakaz = [];
		if ($_SERVER['REQUEST_METHOD'] == "POST"){
			while ($row = mysqli_fetch_assoc($res)) {
				$id = $row['id'];
				$zakaz[] = [
					'id' => $row['id'],
					'price' => $row['price'],
					'count' => $_SESSION['goods'][$id],
				];
			}
			$name = clearStr($_POST['name']);
			$address = clearStr($_POST['address']);
			$zakaz = json_encode($zakaz);

			$sql = "INSERT INTO zakaz(name, address, zakaz) 
					VALUES ('$name', '$address', '$zakaz')";
			mysqli_query(connect(), $sql);
			unset($_SESSION['goods']);
			$_SESSION['msg'] = 'Ваш заказ добавлен';
			header('Location: ?page=bac');
			exit;
		}

		$content = '<h1>Корзина</h1>';
		$content .= '<a href="?page=goods">Все товары</a><br><br><br>';


		while ($row = mysqli_fetch_assoc($res)) {
			$id = $row['id'];
			$count = $_SESSION['goods'][$id];
			$totalPrice = $count * $row['price'];
			$content .=<<<php
			<p>{$row['name']}</p>
			<p>
				Количество:
				<a href="?page=bac&func=del&id={$id}"> - </a>
				$count 
				<a href="?page=bac&func=add&id={$id}"> + </a>
			</p>
			<p>
			Цена: $totalPrice руб.
			</p>
			<hr>
php;
		}
		$content .= getform();
		return $content;
	}

	function add(){
		$id = (int) $_GET['id'];
		if (! empty ($_SESSION['goods'][$id])){
			$_SESSION['goods'][$id] += 1;
		} else {
			$_SESSION['goods'][$id] = 1;
		}

		if ($_SERVER['REQUEST_METHOD'] == "POST"){
			return count($_SESSION['goods']);
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;

	}
	function del(){
		$id = (int) $_GET['id'];
		if (! empty ($_SESSION['goods'][$id])){
			$_SESSION['goods'][$id] -= 1;
		}

		if (isset($_SESSION['goods'][$id]) && $_SESSION['goods'][$id] < 1){
			unset($_SESSION['goods'][$id]);
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;

	}
	function addAjax(){
		echo add();
		exit;
	}

function getform(){
	return <<<php
	<form action="" method="post">
		<input type="text" name="name" placeholder="name">
		<input type="text" name="address" placeholder="address">
		<input type="submit">
	</form>
php;
}