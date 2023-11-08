<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'elibrary';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_error()) {
    exit('Error connecting to databse' . mysqli_connect_error());
}

if (!isset($_POST['name'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['password-repeat'])) {
    exit('Empty Field(s)');
}

if (empty($_POST['name']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password-repeat'])){
    exit('Values Empty');
}

if ($stmt = $conn->prepare('SELECT user_id, password FROM users where name = ?')){
    $stmt->bind_param('s', $_POST['name']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt = $conn->prepare('INSERT INTO users (name, last_name, password, email) VALUES (?, ?, ?, ?)')) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->bind_param('ssss', $_POST['name'], $_POST['lastname'], $password, $_POST['email']);
        $stmt->execute();
        echo 'Successfully Registered';
    }
    else {
        echo 'Register Error';
    }
}
$stmt->close();

$conn->close();
?>
