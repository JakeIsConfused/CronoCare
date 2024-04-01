<?php
// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verwerk het ingediende formulier
    // Hier kun je de ontvangen gegevens verwerken en opslaan, bijvoorbeeld in een database

    // Voor dit voorbeeld slaan we de gegevens op in sessievariabelen
    session_start();
    $_SESSION["theme"] = $_POST["theme"];
    $_SESSION["language"] = $_POST["language"];

    // Stuur de gebruiker door naar de instellingenpagina om de wijzigingen te zien
    header("Location: settings.php");
    exit();
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Instellingen</title>
    </head>
    <body>
    <h1>Instellingen</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="theme">Thema:</label>
        <select name="theme" id="theme">
            <option value="light">Licht</option>
            <option value="dark">Donker</option>
        </select><br><br>

        <label for="language">Taal:</label>
        <select name="language" id="language">
            <option value="english">Engels</option>
            <option value="dutch">Nederlands</option>
        </select><br><br>

        <input type="submit" value="Opslaan">
    </form>
    </body>
    </html>
<?php
