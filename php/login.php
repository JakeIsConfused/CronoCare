<?php
session_start();
$login = false;
global $mysql;

if (isset($_SESSION['user'])) {
    $name = $_SESSION['user']['first_name'];
}

/** @var mysqli $db */
require "php/includes/database.php";


if (isset($_POST['submit'])) {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Server-side validation
    $errors = [];
    if ($email == "") {
        // Maak een error message
        $errors['email'] = "Vul iets in";
    }

    if ($password == "") {
        // Maak een error message
        $errors['password'] = "Vul iets in";
    }

    print_r($errors);

    // If data valid
    if (empty($errors)) {
        // SELECT the user from the database, based on the email address.
        $query = "SELECT * FROM `users ` WHERE `email` = '$email'";
        $result = mysqli_query($mysql, $query)
        or die('error');

        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: index.php');
            } else {
                $errors['loginFailed'] = "Entered wrong credentials";
            }
        } else {
            $errors['loginFailed'] = "Entered wrong credentials";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title name="Home"> CronoCare- Home</title>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body>
        <nav>

        </nav>
        <header>
            <h1 class="headerText">CronoCare</h1>
            <h3 class="headerText">LIFE ISN'T PERFECT, BUT YOUR HAIR CAN BE.</h3>
        </header>
        <main>
            <divLoo></divLoo>
            <div class="loginformulier">

                <form action="" method="POST">
                    Log in
                    <div>
                        <h2>Email:<br></h2>
                        <input type="email" name="email">
                    </div>
                    <div>
                        <h2>Wachtwoord:<br></h2>
                        <input type="password" name="password">
                    </div>
                    <div>
                        <button type="submit" label="" name="submit">Inloggen</button>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>