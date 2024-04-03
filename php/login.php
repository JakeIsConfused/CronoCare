<?php
session_start();
$login = false;
global $mysql;

if (isset($_SESSION['user'])) {
    $name = $_SESSION['user']['first_name'];
}

/** @var mysqli $db */
require "includes/database.php";



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
<html class="full" lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title name="Home"> CronoCare- Home</title>
        <link rel="stylesheet" href="/CronoCare/css/style.css">
    </head>
    <body>
        <main>
<section>

            <div class="left-div">
                <img class="logolog" src="/CronoCare/css/img/logo.png">

                <h4 class="">Welkom bij Cronocare</h4>
                <p>Makkelijk je route te vinden met Cronocare</p>

            </div>
            <div class="right-div">

                <form action="" method="POST">
                    <h2>Log in</h2>
                    <div>
                        <p>Email:<br></p>
                        <input type="email" name="email">
                    </div>
                    <div>
                        <p>Wachtwoord:<br></p>
                        <input type="password" name="password">
                    </div>
                    <div class="bb">
                        <button class="allbutton" type="submit" label="" name="submit">Inloggen</button>
                    </div>

                    <div class="ob">
                        <button class="bbutton" type="submit" label="" name="submit">registreer je hier</button>
                    </div>
                </form>
            </div>
            </section>

        </main>
    </body>
</html>