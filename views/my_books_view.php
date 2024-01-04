<?php
require_once '../php/config_session.php';
require_once '../php/my_books_contr.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Books</title>
    <link rel="stylesheet" href="../css/my_books.css">
</head>
<body>

<header>
    <?php
    require_once '../php/topnav.php';
    ?>
</header>

<?php
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    check_borrowed_books($user_id);

    if (get_user_role($_SESSION["user_id"]) === 'admin') {
        $user_id = $_GET['id'] ?? null;
    }
    if ($user_id == null) $user_id = $_SESSION["user_id"];

    if (isset($_GET['purchase_successful']))
    {
        ?>
            <script>
                localStorage.clear();
            </script>
        <?php
    }
?>

    <div class="main">
        <div class="borrowed-h">
            <h2>Borrowed</h2>
        </div>
        <div class="borrowed-wrap">
            <?php
            get_borrowed_books($user_id);
            ?>
        </div>

        <div class="purchased-h">
            <h2>Purchased</h2>
        </div>
        <div class="purchased-wrap">
            <div class="row">

                <?php
                get_purchased_books($user_id);
                ?>

            </div>
        </div>
    </div>

<?php
}
require_once "../php/footer.php";
?>

</body>
