<?php
require 'header.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $colore = $_POST['colore'];

    $checkSquadra = 'SELECT * FROM casaautomobilistica where Nome = :nome';
    $stmtCheckSquadra = $db -> prepare($checkSquadra);
    $stmtCheckSquadra -> bindParam(':nome', $nome);

    $query = 'INSERT INTO CasaAutomobilistica (Nome, ColoreLivrea) VALUES (:nome, :colore)';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':colore', $colore);

    if ($stmt->execute()) {
        echo "<p>Scuderia aggiunta con successo!</p>";
    } else {
        echo "<p>Errore durante l'inserimento della Scuderia.</p>";
    }
}
?>

<h1>Inserisci una nuova scuderia</h1>
<form method="POST" action="creazioneSquadra.php">
    <label>Nome:</label> <input type="text" name="nome" required><br>
    <label>Colore livrea:</label> <input type="text" name="colore" required><br>
    <button type="submit">Aggiungi</button>
</form>

<?php require 'footer.php'; ?>