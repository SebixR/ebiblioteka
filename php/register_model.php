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

function set_user(object $pdo, string $name, string $lastname, string $email, string $password): void
{
    $query = "INSERT INTO users (name, last_name, email, password, role) VALUES (:name, :lastname, :email, :password, 'user')";
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

function set_bookcase($pdo, $user_id): void
{
    $query = "INSERT INTO bookcases (user_id, book_amount, max_book_amount) VALUES (:user_id, 0, 200)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
}

function fetch_user_id($pdo, $email): int
{
    $query = "SELECT * FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['user_id'];
}
