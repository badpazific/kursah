<?php
header("Access-Control-Allow-Origin: http://217.71.129.139:4496/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/core.php';
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

$data = json_decode(file_get_contents("php://input"));

// Получение jwt
$jwt = isset($data->jwt) ? $data->jwt : "";

// Если jwt не пуст
if($jwt) {

	// Если декодирование выполнено успешно, показать данные пользователя
	try {
		// Декодирование jwt
		$decoded = JWT::decode($jwt, $key, array('HS256'));

		// Код ответа
		http_response_code(200);

		// Показать детали
		echo json_encode(array(
			"message" => "Доступ разрешен",
			"data" => $decoded->data
		));
	}

	// Если декодирование не удалось
	catch (Exception $e){
		// Код ответа
		http_response_code(401);

		// Сообщить пользователю отказано в доступе
		echo json_encode(array(
			"message" => "Доступ закрыт",
			"error" => $e->getMessage()
		));
	}
}

// Если jwt пуст
else{

	// Код ответа
	http_response_code(401);

	// Сообщить пользователю отказано в доступе
	echo json_encode(array("message" => "Доступ запрещён"));
}
?>