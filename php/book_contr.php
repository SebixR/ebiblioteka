<?php

declare(strict_types=1);

function get_cover_image(int $book_id): void
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_book_info($pdo, $book_id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $image = $row['cover_img'];

    echo "<img src='../images/$image' alt='Book Title' class='cover'>";
}

function get_book_info(int $book_id): void
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_book_info($pdo, $book_id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $title = $row['title'];
    $publisher_id = $row['publisher_id'];
    $publisher = get_publisher_name($publisher_id);
    $release_date = $row['release_date'];
    $pages = $row['page_number'];
    $stmt = null;

    $stmt = fetch_authors($pdo, $book_id);

    echo "<label>Title: $title</label>";
    echo "<label>Author/s:</label>";
    echo "<div class='authors-or-genres'>";
    if ($stmt)
    {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $author_data = get_author_info($row['author_id']);
            $name = ucfirst($author_data['name']);
            $lastname = ucfirst($author_data['last_name']);

            echo "<label>$name $lastname  </label>";
        }
    }
    $stmt = null;
    echo "</div>";
    echo "<label>Publisher: $publisher</label>";
    echo "<label>Release Date: $release_date</label>";
    echo "<label>Pages: $pages</label>";
    echo "<label>Genres:</label>";
    echo "<div class='authors-or-genres''>";
    $stmt = fetch_genres($pdo, $book_id);
    if ($stmt)
    {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $genre_name = get_genre_name($row['genre_id']);
            echo "<label>$genre_name    </label>";
        }
    }
    echo "</div>";
}

function get_author_info(int $author_id)
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_author_info($pdo, $author_id);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_genre_name(int $genre_id): string
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_genre_name($pdo, $genre_id);
    $genre = $stmt->fetch(PDO::FETCH_ASSOC);
    return ucfirst($genre['name']);
}

function get_publisher_name(int $publisher_id): string
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_publisher($pdo, $publisher_id);
    $publisher = $stmt->fetch(PDO::FETCH_ASSOC);
    return ucfirst($publisher['name']);
}

function get_summary(int $book_id): void
{
    require "connection.php";
    require_once "book_model.php";

    $stmt = fetch_book_info($pdo, $book_id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $summary = $row['summary'];

    echo "<article class='summary'>";
    echo "$summary";
    echo "</article>";
}
