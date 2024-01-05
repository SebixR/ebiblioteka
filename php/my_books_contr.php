<?php

declare(strict_types=1);

function check_borrowed_books($user_id): void
{
    try {

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

        $stmt = fetch_borrowed_books($pdo, $bookcase_id);
        if ($stmt)
        {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $book_id = $row['book_id'];
                $time = $row['rental_time'];

                $rental_time = new DateTime($time);
                $current_time = new DateTime();

                if ($rental_time <= $current_time)
                {
                    give_book_back($pdo, $book_id, $bookcase_id, $time);
                }
            }
        }

    } catch (Exception $e) {
        die("Query failed: " . $e->getMessage());
    }

}

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
    $counter = 0;
    if ($stmt)
    {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $book_id = (int)$row['book_id'];
            $stmt_book = fetch_book_info($pdo, $book_id);
            $book_info = $stmt_book->fetch(PDO::FETCH_ASSOC);
            $cover = $book_info['cover_img'];
            $title = $book_info['title'];
            $time = $row['rental_time'];

            echo "<div class='item'>";
            echo "<a href='../books/lorem-ipsum.pdf'>";
            echo "<img src='../images/$cover' class='img' alt='$title'>";
            echo "</a>";
            echo "<a href='../books/lorem-ipsum.pdf' class='time-label'>$time</a>";
            echo "</div>";
            $counter++;
        }
    }
    if ($counter == 0) echo "<label style='color: #3d2410; padding: 8px'>No borrowed books found.</label>";

    echo "</div>";

}

function get_purchased_books(int $user_id): void
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

    $stmt = fetch_purchased_books($pdo, $bookcase_id);
    $counter = 0;
    if ($stmt)
    {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $book_id = (int)$row['book_id'];
            $stmt_book = fetch_book_info($pdo, $book_id);
            $book_info = $stmt_book->fetch(PDO::FETCH_ASSOC);
            $cover = $book_info['cover_img'];
            $title = $book_info['title'];

            echo "<div class='row-item'>";
            echo "<a href='../books/lorem-ipsum.pdf'>";
            echo "<img src='../images/$cover' alt='$title'>";
            echo "</a>";
            echo "</div>";
            $counter++;
        }
    }
    if ($counter == 0) echo "<label style='color: #3d2410; padding: 8px'>No purchased books found.</label>";
}
