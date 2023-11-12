<?php

declare(strict_types=1); //not necessary - allowing code to have type declarations, might prevent errors

function is_input_empty(string $name, string $lastname, string $email, string $password, string $password_reap): bool
{
    if (empty($name) || empty($lastname) || empty($email) || empty($password) || empty($password_reap)) {
        return true;
    } else return false;
}

function is_email_invalid(string $email): bool
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else return false;
}

function is_email_registered(object $pdo , string $email)
{
    if (get_email($pdo,  $email)) {
        return true;
    } else return false;
}

function password_repeated_correctly(string $password, string $password_reap){
    if (strcmp($password, $password_reap) != 0) return true; //returns ture when wrong
    else return false;
}