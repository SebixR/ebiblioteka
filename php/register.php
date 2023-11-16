<?php

declare(strict_types=1);

//if ($_SERVER["REQUEST_METHOD"] === "POST") //did the user access this form legitimately
if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
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
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email used!";
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

        create_user( $pdo,  $name, $lastname, $email, $password);

        header("Location: ../index.php?signup=success"); //sends the user there

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} /*else {
    header("Location: ../index.php"); //sends the user there
    die();
}*/

function check_register_error(): void
{
    if (isset($_SESSION["error_register"])) {
        $errors = $_SESSION["error_register"];

        echo "<br>";
        foreach ($errors as $error) {
            echo '<div class="error-wrap">';
            echo '<p class="form-error">' . $error . '</p>';
            echo '</div>';
        }

        unset($_SESSION["error_register"]); //don't need this data anymore
    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<br>';
        echo '<p class="form-success">Succesfully registered</p>';
    }
}