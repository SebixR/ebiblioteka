<?php

declare(strict_types=1);

function is_input_empty(string $title, array $genres, array $authors, string $date, string $publisher, float $purchase, float $borrow, int $pages, string $summary): bool
{
    if (empty($title) || empty($genres) || empty($authors) || empty($date) || empty($publisher) || empty($purchase) || empty($borrow) || empty($pages) || empty($summary)) {
        return true;
    } else return false;
}

function check_authors(object $pdo, array $authors): bool
{
    if (find_authors($pdo, $authors)) return false;
    else return true;
}

function check_publisher(object $pdo, string $publisher): bool
{
    if (find_publisher($pdo, $publisher)) return false;
    else return true;
}

function check_duplicate_author_in_list(array $authors): bool
{
    for ($i = 0; $i < count($authors); $i++)
    {
        $checked_name = $authors[$i]['name'];
        $checked_lastname = $authors[$i]['lastname'];
        for ($j = 0; $j < count($authors); $j++)
        {
            if ($j != $i)
            {
                $name = $authors[$j]['name'];
                $lastname = $authors[$j]['lastname'];

                if ($name == $checked_name && $lastname == $checked_lastname) return true;
            }
        }
    }

    return false;
}
