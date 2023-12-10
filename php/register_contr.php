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

function is_name_invalid(string $name): bool
{
    $uppercase = preg_match('/^[a-zA-Z]+$/', $name);
    $lowercase = preg_match('/^[a-zA-Z]+$/', $name);
    if(!$uppercase || !$lowercase) {
        return true;
    }
    else return false;
}

function is_email_registered(object $pdo , string $email): bool
{
    if (get_email($pdo,  $email)) {
        return true;
    } else return false;
}

function password_repeated_correctly(string $password, string $password_reap): bool
{
    if (strcmp($password, $password_reap) != 0) return true; //returns ture when wrong
    else return false;
}

function password_complexity_met(string $password): bool
{
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        return true;
    }
    else return false;
}

function create_user(object $pdo, string $name, string $lastname, string $email, string $password): void
{
    set_user($pdo, $name, $lastname, $email, $password);
}