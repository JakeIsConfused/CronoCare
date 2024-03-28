<?php
session_start();
$login = false;
global $mysql;

if (isset($_SESSION['users'])) {
    $name = $_SESSION['users']['first_name'];
}

/** @var mysqli $db */
require_once "backend/php/includes/database.php";


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
        $query = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($mysql, $query)
        or die('error');

        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: index.php');
            } else {
                $errors['loginFailed'] = "Wrong email/pw combi";
            }
        } else {
            $errors['loginFailed'] = "Wrong email/pw combi";
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
        <link rel="stylesheet" href="includes/style.css">
    </head>
    <body>
        <nav>
            <img src="images/logo.png" alt="LikiKapsalon Logo" width="150" height="150">
            <?php
            // Check if the user is logged in
            if (isset($_SESSION['user'])) {
                // Display logout link if logged in
                echo '<a href="index.html"> Hallo, ' . $name . ' </a>';
                echo '<a href="view.php">Bekijk je reserveringen</a>';
                echo '<a href="logout.php">Logout</a>';
                echo '<a href="create.php">Maak een afspraak</a>';
            } else {
                // Display login and signup links if not logged in
                echo '<a href="index.php">Home</a>';
                echo '<a href="signup.php">Sign Up</a>';
                echo '<a href="route.php">Home</a>';
                echo '<a href="login.php">Login</a>';
            }
            ?>
        </nav>
        <header>
            <h1 class="headerText">CronoCare</h1    >
            <h3 class="headerText">LIFE ISN'T PERFECT, BUT YOUR HAIR CAN BE.</h3>
        </header>
        <main>
            <div class="">
                <h2>Inloggen</h2>
                <form action="" method="POST">
                    <!-- <input type="hidden" name="user_id" value=""> -->
                    <div>
                        <h2>Email:<br></h2>
                        <input type="email" name="email">
                    </div>
                    <div>
                        <h2>Wachtwoord:<br></h2>
                        <input type="password" name="password">
                    </div>
                    <div>
                        <button type="submit" name="submit">Account Aanmaken</button>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>