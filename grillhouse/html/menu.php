<?php
session_start();
require 'database.php';

// Zoekterm ophalen uit de URL (indien aanwezig)
$zoekterm = isset($_GET['zoek']) ? $_GET['zoek'] : '';


echo "<h1>Op het menu</h1>";

// Zoekformulier tonen
echo '
<form method="get" style="margin-bottom: 20px;">
    <input type="text" name="zoek" placeholder="Zoek een gerecht..." value="' . htmlspecialchars($zoekterm) . '" />
    <button type="submit">Zoek</button>
</form>
';

// Haal gerechten op
if (!empty($zoekterm)) {
    $stmt = $pdo->prepare("SELECT naam, prijs FROM gerechten WHERE naam LIKE ?");
    $stmt->execute(["%" . $zoekterm . "%"]);
    $resultaat = $stmt;
} else {
    $resultaat = $pdo->query("SELECT naam, prijs FROM gerechten");
}

// Begin een lijst
echo "<ul>";

// Toon elk gerecht
while ($gerecht = $resultaat->fetch()) {
    echo "<li>" . htmlspecialchars($gerecht['naam']) . " - €" . htmlspecialchars($gerecht['prijs']) . "</li>";
}

// Sluit de lijst
echo "</ul>";
?>
