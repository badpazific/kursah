<?php
header("Access-Control-Allow-Origin: http://http://217.71.129.139:4496/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/db.php';
include_once 'user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// Отправляемые данные для JSON
$data = json_decode(file_get_contents("php://input"));

$user->login = $data->login;
$user->email = $data->email;
$user->password = $data->password;

if (
		!empty($user->login) &&
		!empty($user->email) &&
		!empty($user->password) &&
		$user->create() // Создание пользователя
	) {
		// Код ответа 
	    http_response_code(200);
	    // Ответ что пользователь был создан 
	    echo json_encode(array("message" => "Пользователь был создан."));
	}
	else {
		// Код ответа
	    http_response_code(400);
	 
	    // Ответ что создать пользователя не удалось 
	    echo json_encode(array("message" => "Невозможно создать пользователя."));
	}
// }
?>