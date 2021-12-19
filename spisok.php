<?php

$ip = "db";
$name = "root";
$password = "123";
$db = "lekarstva";

$induction = mysqli_connect($ip, $name, $password, $db);

if ($induction == false)
{
	echo "Ошибка подключения";
}



?>