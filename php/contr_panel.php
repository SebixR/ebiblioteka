<?php

declare(strict_types=1);

if (isset($_POST["submit-book"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $filename = $_FILES["choosefile"]["name"]; //choosefile - name w inpucie
    //https://www.simplilearn.com/tutorials/php-tutorial/image-upload-in-php
}

if (isset($_POST["submit-genre"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $genre = $_POST["add-genre"];

    try {
        require_once 'connection.php';
        require_once 'contr_panel_model.php';

        if (empty($genre)){
            header("Location: ../views/contr_panel_view.php"); //sends the user there
            die();
        }

        add_genre($pdo, $genre);

        $pdo = null;
        $stmt = null;

        header("Location: ../views/contr_panel_view.php"); //sends the user there
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}

if (isset($_POST["submit-author"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["add-name"];
    $lastname = $_POST["add-lastname"];

    try {
        require_once 'connection.php';
        require_once 'contr_panel_model.php';

        if (empty($name) || empty($lastname)){
            header("Location: ../views/contr_panel_view.php"); //sends the user there
            die();
        }

        add_author($pdo, $name, $lastname);

        $pdo = null;
        $stmt = null;

        header("Location: ../views/contr_panel_view.php"); //sends the user there
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}

if (isset($_POST["submit-publisher"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $publisher = $_POST["add-publisher"];

    try {
        require_once 'connection.php';
        require_once 'contr_panel_model.php';

        if (empty($publisher)) {
            header("Location: ../views/contr_panel_view.php"); //sends the user there
            die();
        }

        add_publisher($pdo, $publisher);

        $pdo = null;
        $stmt = null;

        header("Location: ../views/contr_panel_view.php"); //sends the user there
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
