<?php

declare(strict_types=1);

function get_user_info($user_id): void
{
    try {
        require "connection.php";
        require_once "user_settings_model.php";

        $stmt = fetch_user_info($pdo, $user_id);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $name = ucfirst($row['name']);
        $lastname = ucfirst($row['last_name']);
        $email = $row['email'];

        echo "<label> Name";
        echo "<input value='$name' type='text' class='textbox' name='name' placeholder='Name'>";
        echo "</label>";
        echo "<label> Last Name";
        echo "<input value='$lastname' type='text' class='textbox' name='lastname' placeholder='Last Name'>";
        echo "</label>";
        echo "<label> Email Address";
        echo "<input value='$email' class='textbox' disabled>";
        echo "</label>";

    } catch (Exception $e)
    {
        die("Query failed: " . $e->getMessage());
    }
}

function is_input_empty(string $name, string $lastname): bool
{
    if (empty($name) || empty($lastname)) {
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
