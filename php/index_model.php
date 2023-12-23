<?php

function fetch_books_main(object $pdo)
{
    $query = "SELECT * FROM books";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt;
}

function fetch_search_results($pdo, $search)
{
    $query = "SELECT * FROM books WHERE LOWER(title) LIKE LOWER(:search)";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":search", '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
}

function fetch_books_filtered(object $pdo, array $genres, string $name, string $lastname, string $publisher)
{
    $books = array();
    $flag = 0;

    if (count($genres) > 0) {
        $query_books = "SELECT * FROM genre_book WHERE genre_id IN ('" . implode("', '", $genres) . "')";
        $stmt = $pdo->prepare($query_books);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $books[] = $row['book_id'];
        }

        $genre_count = count($genres);
        $book_counts = array_count_values($books);
        $unique_books = array_filter($book_counts, function($count) use ($genre_count) {
            return $count > $genre_count - 1;
        });

        $unique_keys = array_keys($unique_books);

        $books = array_filter($books, function ($value) use ($unique_keys) {
            return in_array($value, $unique_keys);
        });

        $stmt = null;
        $flag++;
    }

    if ($name != "not" && $lastname != "not")
    {
        $query_author = "SELECT * FROM authors WHERE name = :name AND last_name = :lastname";
        $stmt = $pdo->prepare($query_author);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
        {

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $author_id = $row['author_id'];
            $stmt = null;

            $query_authors = "SELECT * FROM author_book WHERE author_id = :author_id";
            $stmt = $pdo->prepare($query_authors);
            $stmt->bindParam(":author_id", $author_id);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $books[] = $row['book_id'];
            }
        }
        else {
            return $stmt;
        }
        $stmt = null;
        $flag++;
    }


    if ($publisher != "not")
    {
        $query_publisher = "SELECT * FROM publishers WHERE name = :name";
        $stmt = $pdo->prepare($query_publisher);
        $stmt->bindParam(":name", $publisher);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
        {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $publisher_id = $row['publisher_id'];
            $stmt = null;

            $query_books = "SELECT * FROM books WHERE publisher_id = :publisher_id";
            $stmt = $pdo->prepare($query_books);
            $stmt->bindParam(":publisher_id", $publisher_id);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $books[] = $row['book_id'];
            }
        }
        else
        {
            return $stmt;
        }
        $stmt = null;
        $flag++;
    }


    if ($flag > 1)
    {
        $book_counts = array_count_values($books);
        $unique_books = array_filter($book_counts, function($count) {
            return $count >  1;
        });

        $unique_keys = array_keys($unique_books);

        $books = array_filter($books, function ($value) use ($unique_keys) {
            return in_array($value, $unique_keys);
        });
    }


    $query = "SELECT * FROM books WHERE book_id IN ('" . implode("', '", $books) . "')";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt;
}

function fetch_genres(object $pdo)
{
    $query = "SELECT * FROM genres";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt;
}

