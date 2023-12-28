<?php

if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] === "POST") {

    $user_id = $_POST["user_id"];
    $name = strtolower($_POST["name"]);
    $lastname = strtolower($_POST["lastname"]);
    $password = $_POST["password"];
    $password_reap = $_POST["password_confirm"];

    try {
        require_once 'connection.php';
        require_once 'user_settings_model.php';
        require_once 'user_settings_contr.php';

        $errors = [];

        if (is_input_empty($name, $lastname)) {
            $errors["empty_input"] = "Name and Last name must be filled!";
        }
        if ((!empty($password) && empty($password_reap)) || (empty($password) && !empty($password_reap)))
        {
            $errors["empty_repeat"] = "Password wasn't confirmed!";
        }
        if (is_name_invalid($name)) {
            $errors["name_invalid"] = "Name should consist only of lower and uppercase letters!";
        }
        if (is_name_invalid($lastname)) {
            $errors["lastname_invalid"] = "Last Name should consist only of lower and uppercase letters!";
        }
        if (!empty($password) && !empty($password_reap))
        {
            if (password_repeated_correctly($password, $password_reap)) {
                $errors["password_repeat"] = "Passwords do not match!";
            }
            if (password_complexity_met($password)) {
                $errors["password_complexity"] = "Password should include an uppercase character and a number, and should be at least 8 characters long";
            }
        }

        if ($errors) {
            $_SESSION["error_settings"] = $errors;
            echo '<pre>';
            var_dump($_SESSION);
            echo '</pre>';
            header("Location: ../views/user_settings_view.php");
            die();
        }

        if (!empty($password) && !empty($password_reap))
        {
            set_everything($pdo, $user_id, $name, $lastname, $password);
        }
        else
        {
            set_name($pdo, $user_id, $name, $lastname);
        }

        header("Location: ../views/user_settings_view.php");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}

function check_settings_error(): void
{
    if (isset($_SESSION["error_settings"])) {
        $errors = $_SESSION["error_settings"];

        echo "<br>";
        foreach ($errors as $error) {
            echo '<div class="notification-wrap">';
            echo '<p class="notification">' . $error . '</p>';
            echo '</div>';
        }

        unset($_SESSION["error_settings"]); //don't need this data anymore
    }
}