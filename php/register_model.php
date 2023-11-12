<?php
//getting data, submitting data, updating data etc.
//sensitive stuff - so only the controller can access this

declare(strict_types=1); //not necessary - allowing code to have type declarations, might prevent errors

function get_email(object $pdo, string $email)
{
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function set_user(object $pdo, string $name, string $lastname, string $email, string $password) {
    $query = "INSERT INTO users (name, last_name, email, password) VALUES (:name, :lastname, :email, :password)";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12 //prevents bruteforcing
    ];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $hashed_password);
    $stmt->execute();
}