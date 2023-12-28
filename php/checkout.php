<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["pay"])) {

    $user_id = $_POST["user_id"];
    $book_ids = (array)$_POST["book_id"];
    $book_prices = (array)$_POST["book_price"];
    $book_times = (array)$_POST["book_time"];

    try {
        require "connection.php";
        require_once "checkout_model.php";

        $bookcase_id = fetch_bookcase($pdo, $user_id);

        for ($i = 0; $i < count($book_ids); $i++)
        {
            if ($book_times[$i] == 0) //purchased
            {
                set_purchased($pdo, $bookcase_id, $book_ids[$i]);
            }
            else //borrowed
            {
                $current_time = new DateTime();
                if ($book_times[$i] == 24)
                {
                    $current_time->modify('+24 hours');
                }
                else if ($book_times[$i] == 30)
                {
                    $current_time->modify('+30 days');
                }
                else if ($book_times[$i] == 7)
                {
                    $current_time->modify('+7 days');
                }

                $formatted_time = $current_time->format('Y-m-d H:i:s');
                echo "<p>$formatted_time</p>";

                set_borrowed($pdo, $bookcase_id, $book_ids[$i], $formatted_time);
            }
        }

        header("Location: ../views/my_books_view.php");
        $pdo = null;
        $stmt = null;

        die();

    } catch (Exception $e)
    {
        die("Query failed: " . $e->getMessage());
    }



}