<?php 

$db_host='db:3306'; // ваш хост
$db_name='lekarstva'; // ваша бд
$db_user='root'; // пользователь бд
$db_pass='123'; // пароль к бд

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);// включаем сообщения об ошибках

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name); // коннект с сервером бд

$mysqli->set_charset("utf8mb4"); // задаем кодировку

$result = $mysqli->query('SELECT * FROM `uchet`'); // запрос на выборку
/*for ($set = array (); $row = $result->fetch_assoc(); $set[] = $row);

echo json_encode($set);
*/
while($row = $result->fetch_assoc()) {
    echo '
    	<div class="medcss">
	      <a href="#" class="list-group-item list-group-item-action list-group-item-primary">'.$row['name'].'</a>
	      <a href="#" class="list-group-item list-group-item-action list-group-item-primary">'.$row['price'].'</a>
	      <a href="#" class="list-group-item list-group-item-action list-group-item-primary">'.$row['production'].'</a>
	      <a href="#" class="list-group-item list-group-item-action list-group-item-primary">'.$row['releaseform'].'</a>
	      <a href="#" class="list-group-item list-group-item-action list-group-item-primary">'.$row['primarypackaging'].'</a>
	      <a href="#" class="list-group-item list-group-item-action list-group-item-primary">'.$row['Dosage'].'</a>
	      <a href="#" class="list-group-item list-group-item-action list-group-item-primary">'.$row['Volume'].'</a>
	      <a href="#" class="list-group-item list-group-item-action list-group-item-primary">'.$row['inthepackage'].'</a>
	    </div>
	    <br>

    ';

}
?>
