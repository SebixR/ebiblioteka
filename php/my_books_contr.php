<?php

declare(strict_types=1);

function get_borrowed_books(int $user_id): void
{
    require "connection.php";
    require_once "my_books_model.php";

    $stmt = fetch_bookcase($pdo, $user_id);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row)
    {
        $bookcase_id = $row['bookcase_id'];
    }
    else return;
    $stmt = null;

    echo "<div class='borrowed-imgs'>";

    $stmt = fetch_borrowed_books($pdo, $bookcase_id);
    if ($stmt)
    {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $book_id = $row['book_id'];
            $stmt_book = fetch_book_info($pdo, $book_id);
            $book_info = $stmt_book->fetch(PDO::FETCH_ASSOC);
            $cover = $book_info['cover_img'];
            $title = $book_info['title'];
            $time = $row['rental_time'];

            echo "<div class='item'>";
            echo "<a href='book_view.php?id=$book_id'>";
            echo "<img src='../images/$cover' class='img' alt='$title'>";
            echo "</a>";
            echo "<label class='time-label'>$time</label>";
            echo "</div>";
        }
    }

    echo "</div>";

}
