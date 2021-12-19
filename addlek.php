<?php

$name = $_POST['name'];
$price = $_POST['price'];
$production = $_POST['production'];
$releaseform = $_POST['releaseform'];
$primarypackaging = $_POST['primarypackaging'];
$dosage = $_POST['Dosage'];
$volume = $_POST['Volume'];
$inthepackage = $_POST['inthepackage'];


$server = "db";
$username = "root";
$password = "123";
$dbname = "lekarstva";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: ". $conn->connect_error);
}

$sql = "INSERT INTO uchet (name, price, production, releaseform, primarypackaging, Dosage, Volume, inthepackage)
 VALUES ('$name', '$price','$production','$releaseform','$primarypackaging','$dosage','$volume','$inthepackage') ";

if ($conn->query($sql) === TRUE) {
	echo "Данные отправленны";
}	else {
	echo "Error:" . $sql . "<br>" . $conn->error;
}

$conn->close();

?>