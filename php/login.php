<?php

declare(strict_types=1);

if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] === "POST") { //same thing as with registration

    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        require_once 'connection.php';
        require_once 'login_model.php';
        require_once 'login_contr.php';



        $errors = [];

        if (is_input_empty($email, $password)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $email); //pdo is imported from connection.php

        require_once "contr_panel_users_model.php";
        require_once "contr_panel_users_contr.php";
        if (check_user_role($pdo, $result["user_id"]) === 'blocked') {
            $errors["user_blocked"] = "Your account has been blocked by an administrator!";
        }

        if (is_email_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect email!";
        }
        if (!is_email_wrong($result) && is_password_wrong($password, $result["password"])) { //password - column name inside table
            $errors["login_incorrect"] = "Incorrect password!";
        }

        require_once 'config_session.php'; //session security stuff

        if ($errors) {
            $_SESSION["error_login"] = $errors;

            header("Location: ../views/login_view.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["user_id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["user_id"];
        $_SESSION["user_name"] = $result["name"];

        $_SESSION["last_regeneration"] = time(); //reset the time

        header("Location: ../index.php?login=success"); //sends the user there

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}

function output_name()
{
    if (isset($_SESSION["user_id"])) { //if there's a user id that means we're logged in
        echo "You are logged in as " . $_SESSION["user_name"];
    } else {
        echo "You are not logged in";
    }
}

function check_login_errors()
{
    if (isset($_SESSION["error_login"])) {
        $errors = $_SESSION["error_login"];

        echo '<br>';

        foreach ($errors as $error){
            echo '<div class="notification-wrap">';
            echo '<p class="notification">' . $error . '</p>';
            echo '</div>';
        }

        unset($_SESSION["error_login"]);
    }else if (isset($_GET["login"]) && $_GET["login"] === "success") {
        echo '<br>';
        echo '<p class="form-success">Succesfully logged in"</p>';
    }
}

function display_regster_msg(): void
{
    if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<div class="notification-wrap">';
        echo '<p class="notification">You can now log in.</p>';
        echo '</div>';
    }
}
