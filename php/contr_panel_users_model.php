<?php

declare(strict_types=1);

function fetch_users(object $pdo)
{
    $query = "SELECT * FROM users";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt;
}

function delete_user(object $pdo, int $user_id): void
{
    $query = "UPDATE users SET role = 'blocked' WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
}
