<?php
$conn = mysqli_connect("db", "root", "rootpassword", "MENUGOED");

// Stap 1: Toon dropdown met gerechten
if (!isset($_POST['id']) && !isset($_POST['submit'])) {
    $result = mysqli_query($conn, "SELECT * FROM gerechten");

    echo "<form method='post'>";
    echo "<select name='id'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['id'] . "'>" . $row['naam'] . "</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='Wijzig'>";
    echo "</form>";
}

// Stap 2: Toon formulier met huidige waarden
if (isset($_POST['id']) && !isset($_POST['submit'])) {
    $id = $_POST['id'];
    $result = mysqli_query($conn, "SELECT * FROM gerechten WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "Naam: <input type='text' name='naam' value='" . $row['naam'] . "'><br>";
    echo "Prijs: <input type='text' name='prijs' value='" . $row['prijs'] . "'><br>";
    echo "<input type='submit' name='submit' value='Opslaan'>";
    echo "</form>";
}

// Stap 3: Update uitvoeren
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $naam = $_POST['naam'];
    $prijs = $_POST['prijs'];

    mysqli_query($conn, "UPDATE gerechten SET naam='$naam', prijs='$prijs' WHERE id=$id");
    echo "Gerecht bijgewerkt!";
}
?>
<a href="admin_menu.php">← Terug</a>