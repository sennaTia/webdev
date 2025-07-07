<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: /php/login.php');
    exit;
}
?>

<h1>Beheer Gerechten</h1>
<a href="../gerecht_toevoegen.php">Gerecht Toevoegen</a><br>
<a href="../gerecht_verwijderen.php">Gerecht Verwijderen</a><br>
<a href="../php/gerecht_wijzigen.php">Gerecht Wijzigen</a><br>
<a href="php/logout.php">Uitloggen</a>
