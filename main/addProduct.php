<?php
function index() {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = clearStr($_POST['name']);
        $info = clearStr($_POST['info']);
        $price = clearStr($_POST['price']);

        $sql = "INSERT INTO goods
            (name, info, price)
            VALUES
            ('$name', '$info', '$price')";
        mysqli_query(connect(), $sql);
        $_SESSION['msg'] = 'Товар добавлен в базу данных.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $content =<<<php
    <h3>Введите новый товар:</h3>
    <form action="" method="post">
		<input type="text" name="name" placeholder="name">
		<input type="text" name="info" placeholder="info">
		<input type="text" name="price" placeholder="price">
		<input type="submit">
	</form>
php;

    return $content;
}