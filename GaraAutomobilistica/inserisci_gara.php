<?php
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['data'];
    $circuito = $_POST['circuito'];
    $pilotaID = $_POST['pilotaID'];
    $posizione = $_POST['posizione'];
    $tempoMigliore = $_POST['tempoMigliore'];

    $database = new Database();
    $conn = $database->getConnection();

    $query = "INSERT INTO Gara (Data, Circuito, PilotaID, Posizione, TempoMigliore) VALUES (:data, :circuito, :pilotaID, :posizione, :tempoMigliore)";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":data", $data);
    $stmt->bindParam(":circuito", $circuito);
    $stmt->bindParam(":pilotaID", $pilotaID);
    $stmt->bindParam(":posizione", $posizione);
    $stmt->bindParam(":tempoMigliore", $tempoMigliore);

    if ($stmt->execute()) {
        echo "Gara inserita con successo!";
    } else {
        echo "Errore durante l'inserimento della gara.";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci Gara</title>
</head>
<body>
<h1>Inserisci Gara</h1>
<form action="inserisci_gara.php" method="POST">
    <label for="data">Data:</label>
    <input type="date" id="data" name="data" required><br><br>

    <label for="circuito">Circuito:</label>
    <input type="text" id="circuito" name="circuito" required><br><br>

    <label for="pilotaID">ID Pilota:</label>
    <input type="number" id="pilotaID" name="pilotaID" required><br><br>

    <label for="posizione">Posizione:</label>
    <input type="number" id="posizione" name="posizione" required><br><br>

    <label for="tempoMigliore">Tempo Migliore (hh:mm:ss):</label>
    <input type="time" id="tempoMigliore" name="tempoMigliore" step="1"><br><br>

    <button type="submit">Aggiungi Gara</button>
</form>
</body>
</html>

