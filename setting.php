
<?php
// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verwerk het ingediende formulier
    // Hier kun je de ontvangen gegevens verwerken en opslaan, bijvoorbeeld in een database

    // Voor dit voorbeeld slaan we de gegevens op in sessievariabelen
    session_start();
    $_SESSION["theme"] = $_POST["theme"];
    $_SESSION["language"] = $_POST["language"];
    $_SESSION["lettertype"] = $_POST["lettertype"];


    // Stuur de gebruiker door naar de instellingenpagina om de wijzigingen te zien
    header("Location: setting.php");
    exit();
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="backend/js/main.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <title>Instellingen</title>
    </head>
    <body>
    <nav>
        <img src="" alt="">        <img  class="logo" src="css/img/logo.png">
        <div class="navbar-l">
        </div>
    </nav>

    <section class="optie">
        <h1>Instellingen</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="theme">Thema:</label>
            <select name="theme" id="theme">
                <option value="light">Licht</option>
                <option value="dark">Donker</option>
            </select><br><br>

            <label for="language">Taal:</label>
            <select name="language" id="language">
                <option value="dutch">Nederlands</option>
                <option value="english">Engels</option>
            </select><br><br>

            <label for="lettertype">Lettertype:</label>
            <select name="Lettertype" id="lettertype">
                <option value="13">13</option>
                <option value="16">16</option>
                <option value="18">18</option>
                <option value="20">20</option>
            </select><br><br>
    </section>

    <input type="submit" value="Opslaan">
    <button><a href="index.html">Home</a></button>
    </form>
    </body>
    </html>
<?php
