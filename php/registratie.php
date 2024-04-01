<?php
// Access the stored data from the session
global $mysql;
require_once "includes/database.php";
if (isset($_POST['submit'])) {
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST ['email'];
    $password  = $_POST['password'];
    $birthdate=$_POST['birthdate'];



    if (empty($firstname)  || empty($lastname)  || empty($email) ||empty($password)  || empty($birthdate)) {
        echo "Please fill in all the fields.";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users`(first_name,last_name, email, password,birthdate) VALUES ('$firstname','$lastname','$email','$password','$birthdate')";
        $result = $mysql->query($sql);

        if ($result) {
            header('Location: /CronoCare/index.php');
            exit;
        } else {
            $errors['db'] = mysqli_error($mysql);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CronoCare/css/style.css">
    <title>Website</title>
</head>
<body class="register">
<header>
    <nav class="r">
        <img class="profile" src="css/img/veryimportan.jpg">

        <a href="/CronoCare/index.php">Home</a>

    </nav>

</header>
<main class="reginfo">
    <h2>Registreer</h2>
    <section class="reserveringDiv">
        <form action="" method="POST">
            <!-- <input type="hidden" name="user_id" value=""> -->
            <div>
                <h2>Naam:<br></h2>
                <input type="text" name="first_name">
            </div>
            <div>
                <h2>Achternaam:<br></h2>
                <input type="text" name="last_name">
            </div>
            <div>
                <h2>Geboortedatum:<br></h2>
                <input type="date" name="birthdate" required>
            </div>
            <div>
                <h2>Email:<br></h2>
                <input type="email" name="email">
            </div>
            <div>
                <h2>Wachtwoord:<br></h2>
                <input type="password" name="password">
            </div>
            <div>
                <label for="agree_checkbox">
                    <input type="checkbox" id="agree_checkbox" name="agree_checkbox" required>
                    Door op Aanmelden te klikken, gaat u akkoord met onze Voorwaarden. Ontdek hoe we uw gegevens
                    verzamelen, gebruiken en delen in ons Privacybeleid en hoe we cookies en
                    soortgelijke technologie gebruiken in ons Cookiebeleid.


                </label><br>
                <br>
            </div>
            <div>
                <button type="submit" name="submit">Aanmelden</button>
            </div>
        </form>
    </section>
</main>
</body>
</html>

