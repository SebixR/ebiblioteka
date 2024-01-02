<?php
require_once '../php/config_session.php';
require_once '../php/contr_panel_books.php';
require_once '../php/topnav_contr.php';
?>
    <!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control Panel</title>
    <link rel="stylesheet" href="../css/contr_panel_books.css">
</head>
<body>

<?php
if (isset($_SESSION["user_id"])) {
    if (get_user_role($_SESSION["user_id"]) === 'admin') {
        ?>

<div class="main">
    <header>
        <?php
        require_once '../php/topnav.php';
        ?>
    </header>

    <div class="control-panel-menu">
        <a class="panel-menu-button-active" href="contr_panel_books_view.php">View Books</a>
        <a class="panel-menu-button" href="contr_panel_add_view.php">Add Entry</a>
        <a class="panel-menu-button" href="contr_panel_users_view.php" style="float:right">View Users</a>
    </div>

    <div class="books">
        <?php
        get_books();
        ?>
    </div>

</div>
        <?php
        require_once "../php/footer.php";
        ?>
</body>
<?php
    }
}
