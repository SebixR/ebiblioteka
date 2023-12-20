<?php

declare(strict_types=1);

if (isset($_POST["submit-book"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $genres = (array)$_POST["genres"];
    foreach ($genres as &$genre) //& - so that the array doesn't copy genres, but alters the original data
    {
        $genre = strtolower($genre);
    }
    $authors = (array)$_POST["authors"];
    foreach ($authors as &$author)
    {
        $author['name'] = strtolower($author['name']);
        $author['lastname'] = strtolower($author['lastname']);
    }
    $date = $_POST["date"];
    $publisher = strtolower($_POST["publisher"]);
    $purchase = (float)$_POST["purchase"];
    $borrow = (float)$_POST["borrow"];
    $pages = (int)$_POST["pages"];
    $summary = $_POST["summary"];

    $filename = $_FILES["choosefile"]["name"]; //choosefile - name in the input
    $tempname = $_FILES["choosefile"]["tmp_name"];
    $folder = "../images/".$filename;

    $book_errors = [];

    try {
        require_once 'connection.php';
        require_once 'contr_panel_add_model.php';
        require_once 'contr_panel_add_contr.php';

        if (is_input_empty($title, $genres, $authors, $date, $publisher, $purchase, $borrow, $pages, $summary, $filename)){
            $book_errors["empty_input"] = "Some fields are empty.";
        }
        if (check_authors($pdo, $authors)){
            $book_errors["missing_author"] = "No such author in the database.";
        }
        if (check_publisher($pdo, $publisher)){
            $book_errors["missing_publisher"] = "No such publisher in the database.";
        }
        if (move_uploaded_file($tempname, $folder)){
            $msg = "Image uploaded successfully.";
        }
        else {
            $book_errors["failed_file"] = "Failed to upload image.";
        }

        require_once 'config_session.php';

        if ($book_errors) {
            $_SESSION["error_add_book"] = $book_errors;
            header("Location: ../views/contr_panel_add_view.php");
            die();
        }

        add_book($pdo, $title, $genres, $authors, $date, $publisher, $purchase, $borrow, $pages, $summary, $filename);

        $pdo = null;

        header("Location: ../views/contr_panel_add_view.php");
        echo '<div class="notification-wrap">';
        echo '<p class="notification">Succesfully added book.</p>';
        echo '</div>';
        die();

    }  catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

}
function check_add_error(): void
{
    if (isset($_SESSION["error_add_book"])) {
        $errors = $_SESSION["error_add_book"];

        echo "<br>";
        foreach ($errors as $error) {
            echo '<div class="notification-wrap">';
            echo '<p class="notification">' . $error . '</p>';
            echo '</div>';
        }

        unset($_SESSION["error_add_book"]);
    }
}



if (isset($_POST["submit-genre"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $genre = strtolower($_POST["add-genre"]);

    $genre_errors = [];

    try {
        require_once 'connection.php';
        require_once 'contr_panel_add_model.php';
        require_once 'contr_panel_add_contr.php';

        if (empty($genre)){
            $genre_errors["empty_input"] = "Field is empty.";
        }
        else if (check_duplicate_genre($pdo, $genre)){
            $genre_errors["duplicate_genre"] = "Genre is already in the database.";
        }

        require_once 'config_session.php';

        if ($genre_errors) {
            $_SESSION["error_genre"] = $genre_errors;
            header("Location: ../views/contr_panel_add_view.php");
            die();
        }

        add_genre($pdo, $genre);

        $pdo = null;

        header("Location: ../views/contr_panel_add_view.php");
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
if (isset($_POST["delete-genre"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $genre = strtolower($_POST["add-genre"]);

    $genre_errors = [];

    try {
        require_once 'connection.php';
        require_once 'contr_panel_add_model.php';
        require_once 'contr_panel_add_contr.php';

        if (empty($genre)) {
            $genre_errors["empty_input"] = "Field is empty.";
        }
        else if (check_genre($pdo, $genre)){
            $genre_errors["missing_genre"] = "No such genre in the database.";
        }
        else if (check_genre_connections($pdo, $genre)){
            $genre_errors["used_genre"] = "This genre has books assigned to it.";
        }

        require_once 'config_session.php';

        if ($genre_errors) {
            $_SESSION["error_genre"] = $genre_errors;
            header("Location: ../views/contr_panel_add_view.php");
            die();
        }

        delete_genre($pdo, $genre);

        $pdo = null;

        header("Location: ../views/contr_panel_add_view.php");
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
function check_genre_error(): void
{
    if (isset($_SESSION["error_genre"])) {
        $errors = $_SESSION["error_genre"];

        echo "<br>";
        foreach ($errors as $error) {
            echo '<div class="notification-wrap">';
            echo '<p class="notification">' . $error . '</p>';
            echo '</div>';
        }

        unset($_SESSION["error_genre"]);
    }
}



if (isset($_POST["submit-author"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $name = strtolower($_POST["add-name"]);
    $lastname = strtolower($_POST["add-lastname"]);

    $author_errors = [];

    try {
        require_once 'connection.php';
        require_once 'contr_panel_add_model.php';
        require_once 'contr_panel_add_contr.php';

        if (empty($name) || empty($lastname)){
            $author_errors["empty_input"] = "Some fields are empty.";
        }
        else if (check_duplicate_author($pdo, $name, $lastname)){
            $author_errors["duplicate_author"] = "Author is already in the database.";
        }

        require_once 'config_session.php';

        if ($author_errors) {
            $_SESSION["error_author"] = $author_errors;
            header("Location: ../views/contr_panel_add_view.php");
            die();
        }

        add_author($pdo, $name, $lastname);

        $pdo = null;

        header("Location: ../views/contr_panel_add_view.php");
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
if (isset($_POST["delete-author"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $name = strtolower($_POST["add-name"]);
    $lastname = strtolower($_POST["add-lastname"]);

    $author_errors = [];

    try {
        require_once 'connection.php';
        require_once 'contr_panel_add_model.php';
        require_once 'contr_panel_add_contr.php';

        if (empty($name) || empty($lastname)) {
            $author_errors["empty_input"] = "Some fields are empty.";
        }
        else if (check_author($pdo, $name, $lastname)){
            $author_errors["missing_author"] = "No such author in the database.";
        }
        else if (check_author_connections($pdo, $name, $lastname)){
            $author_errors["used_author"] = "This author has books assigned to them.";
        }

        require_once 'config_session.php';

        if ($author_errors) {
            $_SESSION["error_author"] = $author_errors;
            header("Location: ../views/contr_panel_add_view.php");
            die();
        }

        delete_author($pdo, $name, $lastname);

        $pdo = null;

        header("Location: ../views/contr_panel_add_view.php");
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}function check_author_error(): void
{
    if (isset($_SESSION["error_author"])) {
        $errors = $_SESSION["error_author"];

        echo "<br>";
        foreach ($errors as $error) {
            echo '<div class="notification-wrap">';
            echo '<p class="notification">' . $error . '</p>';
            echo '</div>';
        }

        unset($_SESSION["error_author"]);
    }
}


if (isset($_POST["submit-publisher"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $publisher = strtolower($_POST["add-publisher"]);

    $publisher_errors = [];

    try {
        require_once 'connection.php';
        require_once 'contr_panel_add_model.php';
        require_once 'contr_panel_add_contr.php';

        if (empty($publisher)) {
            $publisher_errors["empty_input"] = "Field is empty.";
        }

        require_once 'config_session.php';

        if ($publisher_errors) {
            $_SESSION["error_publisher"] = $publisher_errors;
        }
        else if (check_duplicate_publisher($pdo, $publisher)){
            $publisher_errors["duplicate_publisher"] = "Publisher is already in the database.";
        }

        require_once 'config_session.php';

        if ($publisher_errors) {
            $_SESSION["error_publisher"] = $publisher_errors;
            header("Location: ../views/contr_panel_add_view.php");
            die();
        }

        add_publisher($pdo, $publisher);

        $pdo = null;

        header("Location: ../views/contr_panel_add_view.php");
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
if (isset($_POST["delete-publisher"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $publisher = strtolower($_POST["add-publisher"]);

    $publisher_errors = [];

    try {
        require_once 'connection.php';
        require_once 'contr_panel_add_model.php';
        require_once 'contr_panel_add_contr.php';

        if (empty($publisher)) {
            $publisher_errors["empty_input"] = "Field is empty.";
        }
        else if (check_publisher($pdo, $publisher)){
            $publisher_errors["missing_publisher"] = "No such publisher in the database.";
        }
        else if (check_publisher_connections($pdo, $publisher)){
            $publisher_errors["used_publisher"] = "This publisher has books assigned to them.";
        }

        require_once 'config_session.php';

        if ($publisher_errors) {
            $_SESSION["error_publisher"] = $publisher_errors;
            header("Location: ../views/contr_panel_add_view.php");
            die();
        }

        delete_publisher($pdo, $publisher);

        $pdo = null;

        header("Location: ../views/contr_panel_add_view.php");
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}function check_publisher_error(): void
{
    if (isset($_SESSION["error_publisher"])) {
        $errors = $_SESSION["error_publisher"];

        echo "<br>";
        foreach ($errors as $error) {
            echo '<div class="notification-wrap">';
            echo '<p class="notification">' . $error . '</p>';
            echo '</div>';
        }

        unset($_SESSION["error_publisher"]);
    }
}

function get_genres(): void
{
    require_once "connection.php";
    require_once "contr_panel_add_model.php";

    $stmt = fetch_genres($pdo);
    if ($stmt){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $value = ucfirst($row['name']);
            echo "<li>";
            echo "<label>";
            echo "<input type='checkbox' value=$value name='genres[]' class='genre-check'>$value</input>";
            echo "<span class='checkmark'></span>";
            echo "</label>";
            echo "</li>";
        }
    }
}
