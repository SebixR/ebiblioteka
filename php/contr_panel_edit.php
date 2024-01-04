<?php

declare(strict_types=1);


if (isset($_POST["edit-book"]) && $_SERVER["REQUEST_METHOD"] === "POST") {

    $title = $_POST["title"];
    $genres = (array)$_POST["genres"];
    foreach ($genres as &$genre)
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
    $target_dir = "../images/";
    $cover = $target_dir . basename($_FILES["cover"]["name"]);
    if (!file_exists($cover))
    {
        move_uploaded_file($_FILES["fileInput"]["tmp_name"], $cover);
    }
    $cover_img = $_FILES["cover"]["name"];

    $book_id = (int)$_POST["book_id"];

    $book_errors = [];

    try {
        require_once 'connection.php';
        require_once 'contr_panel_edit_model.php';
        require_once 'contr_panel_edit_contr.php';

        if (is_input_empty($title, $genres, $authors, $date, $publisher, $purchase, $borrow, $pages, $summary)){
            $book_errors["empty_input"] = "Some fields are empty.";
        }
        if (check_authors($pdo, $authors)){
            $book_errors["missing_author"] = "No such author in the database.";
        }
        if (check_publisher($pdo, $publisher)){
            $book_errors["missing_publisher"] = "No such publisher in the database.";
        }
        if (check_duplicate_author_in_list($authors)) {
            $book_errors["duplicate_author_in_list"] = "Two or more identical authors are in the list";
        }

        require_once 'config_session.php';

        if ($book_errors) {
            $_SESSION["error_add_book"] = $book_errors;
            header("Location: ../views/contr_panel_edit_view.php?id=$book_id");
            die();
        }

        edit_book($pdo, $book_id, $title, $genres, $authors, $date, $publisher, $purchase, $borrow, $pages, $summary, $cover_img);

        $pdo = null;

        header("Location: ../views/contr_panel_edit_view.php?id=$book_id");
        echo '<div class="notification-wrap">';
        echo '<p class="notification">Succesfully edited book.</p>';
        echo '</div>';
        die();

    }  catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}

function check_edit_error(): void
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

function get_book_info(int $book_id) {

    try {
        require "connection.php";
        require_once "contr_panel_edit_model.php";

        $stmt = fetch_book_info($pdo, $book_id);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e){
        die("Query failed: " . $e->getMessage());
    }

}

function get_genres(int $book_id): void
{
    try {
        require "connection.php"; //require, not require_once because require_once checks if it's already been required,
        //and if so, doesn't do it again. I think that the require_once in get book info makes it not import it again
        require_once "contr_panel_edit_model.php";

        $stmt = fetch_genres($pdo);
        if ($stmt){
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $value = ucfirst($row['name']);
                echo "<li>";
                echo "<label>";
                if (book_has_genre($book_id, $row['genre_id']))
                {
                    echo "<input type='checkbox' value='$value' name='genres[]' class='genre-check' checked>$value</input>";
                }
                else echo "<input type='checkbox' value='$value' name='genres[]' class='genre-check'>$value</input>";
                echo "<span class='checkmark'></span>";
                echo "</label>";
                echo "</li>";
            }
        }
    } catch (Exception $e){
        die("Query failed: " . $e->getMessage());
    }
}

function book_has_genre(int $book_id, int $genre_id): bool
{
    require "connection.php";
    require_once "contr_panel_edit_model.php";

    if (fetch_book_has_genre($pdo, $book_id, $genre_id) == 1) return true;
    else return false;
}

function get_authors(int $book_id): array
{
    require "connection.php";
    require_once "contr_panel_edit_model.php";

    $stmt = fetch_authors($pdo, $book_id);

    $authors = array();
    $index = 0;
    if ($stmt)
    {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $author_data = get_author_info($row['author_id']);

            $authors[$index]['name'] = $author_data['name'];
            $authors[$index]['lastname'] = $author_data['last_name'];
            $index++;
        }
    }

    return $authors;
}

function get_author_info($author_id)
{
    require "connection.php";
    require_once "contr_panel_edit_model.php";

    $stmt = fetch_author_info($pdo, $author_id);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_publisher_name($publisher_id): string
{
    require "connection.php";
    require_once "contr_panel_edit_model.php";

    $stmt = fetch_publisher($pdo, $publisher_id);
    $publisher = $stmt->fetch(PDO::FETCH_ASSOC);
    return ucfirst($publisher['name']);
}
