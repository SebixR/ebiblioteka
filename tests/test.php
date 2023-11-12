<?php
    include("database_test.php");

    echo "Hello World <br>";
    echo "Goodbye World <br>";
    $name = "Mike";
    echo "-{$name} <br>";
    if (isset($_POST["submit"])){
        if(isset($_POST["pizza"])){
            echo "you like pizza huh?";
        }
        if(isset($_POST["hamburger"])){
            echo "you like burgers huh?";
        }
        if(isset($_POST["taco"])){
            echo "you like Mexicans huh?";
        }
    }

    if(isset($_POST["login"])){
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $age = filter_input(INPUT_POST, "age", FILTER_SANITIZE_NUMBER_INT);

        if(empty($email)){
            echo "No, no that's not an email you cheeky bastard";
        }
        else echo "Hello {$email}, you are {$age} years old apparently";
    }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <title>Library</title>
</head>
<body>
    <main>
        <div>
            <button class="button">
                press me! god please press me god, please
            </button>
        </div>
        <div>
            <form action="test.php" method="post">
                <input type="checkbox" name="pizza" value="Pizza">
                Pizza<br>
                <input type="checkbox" name="hamburger" value="Hamburger">
                Hamburger<br>
                <input type="checkbox" name="taco" value="Taco">
                Taco<br>
                <input type="submit" name="submit" value="Send">
            </form>
        </div>
        <div>
            <form action="test.php" method="post">
                email:<br>
                <input type="text" name="email"><br> <!--name - nazwa, value - to co się wyświetla-->
                <input type="text" name="age"><br>
                <input type="submit" name="login" value="Login">
            </form>
        </div>
    </main>
</body>
</html>
