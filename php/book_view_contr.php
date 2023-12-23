<?php

declare(strict_types=1);

function get_cover_image(int $book_id): void
{
    require "connection.php";
    require_once "book_view_model.php";

    $stmt = fetch_book_info($pdo, $book_id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $image = $row['cover_img'];

    echo "<img src='../images/$image' alt='Book Title' class='cover'>";
}

function get_book_info(int $book_id): void
{
    require "connection.php";
    require_once "book_view_model.php";

    $stmt = fetch_book_info($pdo, $book_id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $title = $row['title'];
    $publisher_id = $row['publisher_id'];
    $publisher = get_publisher_name($publisher_id);
    $release_date = $row['release_date'];
    $pages = $row['page_number'];

    echo "<label>Title: $title</label>";
    echo "<label>Publisher: $publisher</label>";
    echo "<label>Release Date: $release_date</label>";
    echo "<label>Pages: $pages</label>";
}

function get_publisher_name($publisher_id): string
{
    require "connection.php";
    require_once "book_view_model.php";

    $stmt = fetch_publisher($pdo, $publisher_id);
    $publisher = $stmt->fetch(PDO::FETCH_ASSOC);
    return ucfirst($publisher['name']);
}
