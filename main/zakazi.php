<?php
function index() {
    $sql = "SELECT id, name, address, zakaz FROM zakaz";
    $res = mysqli_query(connect(), $sql);

    $content = '<h1>Заказы клиентов:</h1>';
    while ($row = mysqli_fetch_assoc($res)) {
        $zakaz1 = $row['zakaz'];
        $zakaz = json_decode($zakaz1, true);

        $content .=<<<php
		<h2>{$row['name']}</h2>
		<h3>{$row['address']}</h3>
php;

        foreach ($zakaz as $key1 => $value) {
            foreach ($value as $key => $data) {
                $content .=<<<php
                <p>$key - $data</p>
php;
            }
        }
    }
//    var_dump($zakaz);
    return $content;
}
