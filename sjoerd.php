<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
echo"student' OR '1'='1' --";
$conn = new mysqli(
    "192.168.1.103",
    "webserver",
    "testpw",
    "test"
);

if ($conn->connect_error) {
    die("Databaseverbinding mislukt");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // BEWUST ONVEILIG: SQL-injectie mogelijk
    $sql = "SELECT * FROM users
            WHERE username = '$username'
            AND password = '$password'";




    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $message = "Inloggen geslaagd!";
    } else {
        $message = "Ongeldige inloggegevens.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Demo login</title>
</head>
<body>
    <h1>Inloggen</h1>

    <form method="POST">
        <label>Gebruikersnaam</label>
        <input type="text" name="username" required>

        <label>Wachtwoord</label>
        <input type="password" name="password" required>

        <button type="submit">Inloggen</button>
    </form>

    <p><?= htmlspecialchars($message) ?></p>
</body>
</html>
