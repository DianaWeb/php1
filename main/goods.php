<?
function index() {
	$sql = "SELECT id, name, info, price FROM goods";
	$res = mysqli_query(connect(), $sql);
	$content = '';
	while ($row = mysqli_fetch_assoc($res)) {
		if (! empty($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == IS_ADMIN) {
            $content .=<<<php
		<a href="?page=goods&func=one&id={$row['id']}">{$row['name']}</a>
		<a href="?page=goods&func=deleteGood&id={$row['id']}">Удалить</a>
		<hr>
php;
        } else {
            $content .=<<<php
		<a href="?page=goods&func=one&id={$row['id']}">{$row['name']}</a><hr>
php;
        }
	}
	
	return $content;
}

function one() {
	$id = (int) $_GET['id'];
	$sql = "SELECT id, name, info, price FROM goods WHERE id = $id";
    $res = mysqli_query(connect(), $sql);
    $content = '<a href="?page=goods">Все товары</a><br><br><br>';

    $row = mysqli_fetch_assoc($res);
        $content .=<<<php
        <h1>{$row['name']}</h1>
        <p>{$row['price']}р.</p>
        <p onclick="send($id)" style="cursor: pointer"> Добавить в корзину </p>
        <p>{$row['info']}</p>

php;

$script = file_get_contents(__DIR__ . '/js/send.js');

$content .= "<script>$script</script>";

		return $content;
}

function deleteGood() {
    $id = (int) $_GET['id'];
    $sql = "SELECT id FROM goods WHERE id = $id";
    $res = mysqli_query(connect(), $sql);
    $row = mysqli_fetch_assoc($res);

    $sql2 = "DELETE FROM goods WHERE id = " . $row['id'];
    mysqli_query(connect(), $sql2);
    $_SESSION['msg'] = 'Товар удален из Базы данных.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
