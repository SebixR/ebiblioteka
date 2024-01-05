<?php

declare(strict_types=1);

function is_input_empty(string $email, string $password)
{
    if (empty($email) || empty($password)) {
        return true;
    } else return false;
}

function is_email_wrong(string $result): bool
{
    if (!$result) {
        return true;
    } else{
        return false;
    }
}

function is_password_wrong(string $password, string $hashed_password): bool
{
    if (!password_verify($password, $hashed_password)) {
        return true;
    } else{
        return false;
    }
}