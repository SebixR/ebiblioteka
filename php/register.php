<?php

declare(strict_types=1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {//did the user access this form legitimately
    $name = strtolower($_POST["name"]);
    $lastname = strtolower($_POST["lastname"]);
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_reap = $_POST["password_repeat"];

    try {

        require_once 'connection.php';
        require_once 'register_model.php';
        require_once 'register_contr.php'; //the order is important

        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($name, $lastname, $email, $password, $password_reap)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (password_repeated_correctly($password, $password_reap)) {
            $errors["password_repeat"] = "Passwords do not match!";
        }
        if (password_complexity_met($password)) {
            $errors["password_complexity"] = "Password should include an uppercase character and a number, and should be at least 8 characters long";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email used!";
        }
        if (is_name_invalid($name)) {
            $errors["name_invalid"] = "Name should consist only of lower and uppercase letters!";
        }
        if (is_name_invalid($lastname)) {
            $errors["lastname_invalid"] = "Last Name should consist only of lower and uppercase letters!";
        }
        if (is_email_registered($pdo, $email)) {
            $errors["email_used"] = "Email already registered!";
        }

        require_once 'config_session.php';

        if ($errors) {
            $_SESSION["error_register"] = $errors;
            header("Location: ../views/register_view.php");
            die();
        }

        create_user($pdo,  $name, $lastname, $email, $password);
        $user_id = fetch_user_id($pdo, $email);
        create_bookcase($pdo, $user_id);

        header("Location: ../views/login_view.php?signup=success"); //sends the user there

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

}

function check_register_error(): void
{
    if (isset($_SESSION["error_register"])) {
        $errors = $_SESSION["error_register"];

        echo "<br>";
        foreach ($errors as $error) {
            echo '<div class="notification-wrap">';
            echo '<p class="notification">' . $error . '</p>';
            echo '</div>';
        }

        unset($_SESSION["error_register"]); //don't need this data anymore
    }
}