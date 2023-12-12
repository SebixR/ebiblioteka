<?php
require_once '../php/config_session.php';
require_once '../php/contr_panel_users.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control Panel</title>
    <link rel="stylesheet" href="../css/contr_panel_users.css">
</head>
<body>

<div class="main">
    <header>
        <?php
        require_once '../php/topnav.php';
        ?>
    </header>

    <div class="control-panel-menu">
        <a class="panel-menu-button" href="#">View Books</a>
        <a class="panel-menu-button" href="contr_panel_add_view.php">Add Entry</a>
        <a class="panel-menu-button-active" href="contr_panel_users_view.php" style="float:right">View Users</a>
    </div>

    <div class="user-list">
        <?php
        get_users();
        ?>
    </div>

</div>
</body>
