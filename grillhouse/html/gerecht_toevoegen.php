<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: login.php');
    exit;
}

require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $prijs = $_POST['prijs'];

    $stmt = $pdo->prepare("INSERT INTO gerechten (naam, prijs) VALUES (?, ?)");
    $stmt->execute([$naam, $prijs]);

    echo "Gerecht toegevoegd!";
}
?>

<h1>Gerecht Toevoegen</h1>
<form method="post">
    Naam: <input type="text" name="naam" required><br>
    Prijs: <input type="number" step="0.01" name="prijs" required><br>
    <button type="submit">Toevoegen</button>
</form>
<a href="admin_menu.php">← Terug</a>
