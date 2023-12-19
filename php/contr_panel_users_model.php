<?php

declare(strict_types=1);

function fetch_users(object $pdo)
{
    $query = "SELECT * FROM users";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt;
}

function fetch_user_role(object $pdo, int $user_id)
{
    $query = "SELECT role FROM users where user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    return $stmt;
}

function set_user_role(object $pdo, int $user_id, string $role): void
{
    $query = "UPDATE users SET role = :role WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":role", $role);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
}
