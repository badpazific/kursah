<?php
// Создрание объекта User
class User {
 
    // подключение к БД таблице "users" 
    private $conn;
    private $table_name = "users";
 
    // свойства объекта 
    public $id;
    public $login;
    public $email;
    public $password;
 
    // конструктор класса User 
    public function __construct($db) {
        $this->conn = $db;
    }

    // Создание нового пользователя 
    function create() {
    
        // Вставляем запрос 
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    login = :login,
                    email = :email,
                    password = :password";
    
        // подготовка запроса 
        $stmt = $this->conn->prepare($query);
    
        // Очистка 
        $this->login=htmlspecialchars(strip_tags($this->login));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
    
        // привязываем значения 
        $stmt->bindParam(':login', $this->login);
        $stmt->bindParam(':email', $this->email);
    
        // для защиты пароля 
        // хешируем пароль перед сохранением в базу данных 
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
    
        // Выполняем запрос 
        // Если выполнение успешно, то информация о пользователе будет сохранена в базе данных 
        if($stmt->execute()) {
            return true;
        }
    
        return false;
    }

    function emailExists(){

        $query = "SELECT id, login, password
                FROM " . $this->table_name . "
                WHERE email = ?
                LIMIT 0,1";

        //Подготовка запроса
        $stmt = $this->conn->prepare( $query );

        $this->email=htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(1, $this->email);

        $stmt->execute();

        $num = $stmt->rowCount();

        // Проверка на сощуствование почты

        if($num>0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->firstname= $row['login'];
            $this->password = $row['password'];

            return true;
        }
        // Возврат 'false', если нет почты в бд
        return false;

    }

    // Метод Update()

    public function update() {

        // Если в HTML-форме был введен пароль - необходимо обновить пароль
        $password_set =! empty($this->password) ? ", password = :password" : "";

        // Если пароль не введен - не надо обновлять его
        $query = "UPDATE " . $this->table_name . "
                SET
                    login = :login,
                    email = :email,
                    {password_set}
                WHERE id = :id";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        // Очистка
        $this->login = htmlspecialchars(strip_tags($this->login));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Значения с HTML-формы
        if(!empty($this->password)) {
            $this->password = htmlspecialchars(strip_tags($this->password));
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password',$password_hash);
        } 

        // Уникальный идентификатор записи для редактирования
        $stmt->bindParam(':id', $this->id);

        // Если выполнение успешно, то информация о пользователе будет сохранена в бд
        if($stmt->execute()) {
            return true;
        }

        return false;

    }
}
?>