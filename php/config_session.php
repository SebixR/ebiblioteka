<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1800, // duration of cookie session, if the user's inactive for this long, they will be logged out
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true, //https
    'httponly' => true
]);

session_start();

if (isset($_SESSION["user_id"])) { //check if the user is logged in
    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id_loggedin();
    } else {
        $interval = 60 * 30; //30 minutes - how long we have the same session id
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id_loggedin();
        }
    }
} else
{
    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id();
    } else {
        $interval = 60 * 30; //30 minutes - how long we have the same session id
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id();
        }
    }
}

function regenerate_session_id_loggedin(): void
{
    session_regenerate_id(true);

    $userId = $_SESSION["user_id"];
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $userId;
    session_id($sessionId);

    $_SESSION["last_regeneration"] = time();

    require_once "my_books_contr.php";
    check_borrowed_books($userId);
}

function regenerate_session_id(): void
{
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}