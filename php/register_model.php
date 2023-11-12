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