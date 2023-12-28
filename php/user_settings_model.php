<?php

declare(strict_types=1);

function fetch_user_info(object $pdo, int $user_id)
{
    $query = "SELECT * FROM users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    return $stmt;
}

function set_everything(object $pdo, int $user_id, string $name, string $lastname, string $password): void
{
    $query = "UPDATE users SET name = :name, last_name = :lastname, password = :password WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":password", $hashed_password);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
}

function set_name(object $pdo, int $user_id, string $name, string $lastname): void
{
    $query = "UPDATE users SET name = :name, last_name = :lastname WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
}