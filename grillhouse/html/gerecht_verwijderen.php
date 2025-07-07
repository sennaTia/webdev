<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: login.php');
    exit;
}

require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM gerechten WHERE id = ?");
    $stmt->execute([$id]);
    echo "Gerecht verwijderd!";
}

$gerechten = $pdo->query("SELECT * FROM gerechten")->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Gerecht Verwijderen</h1>
<form method="post">
    <select name="id">
        <?php foreach ($gerechten as $gerecht): ?>
            <option value="<?= $gerecht['id'] ?>">
                <?= htmlspecialchars($gerecht['naam']) ?> (€<?= number_format($gerecht['prijs'], 2) ?>)
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Verwijderen</button>
</form>
<a href="admin_menu.php">← Terug</a>
