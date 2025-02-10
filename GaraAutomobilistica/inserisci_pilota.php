<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $nazionalita = $_POST['nazionalita'];
    $numero = $_POST['numero'];
    $casaID = $_POST['casaID'];

    $database = new Database();
    $conn = $database->getConnection();

    $query = "INSERT INTO Piloti (Nome, Cognome, Nazionalità, Numero, CasaID) VALUES (:nome, :cognome, :nazionalita, :numero, :casaID)";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":cognome", $cognome);
    $stmt->bindParam(":nazionalita", $nazionalita);
    $stmt->bindParam(":numero", $numero);
    $stmt->bindParam(":casaID", $casaID);

    if ($stmt->execute()) {
        echo "Pilota inserito con successo!";
    } else {
        echo "Errore durante l'inserimento del pilota.";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci Pilota</title>
</head>
<body>
<h1>Inserisci Pilota</h1>
<form action="inserisci_pilota.php" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="cognome">Cognome:</label>
    <input type="text" id="cognome" name="cognome" required><br><br>

    <label for="nazionalita">Nazionalità:</label>
    <input type="text" id="nazionalita" name="nazionalita" required><br><br>

    <label for="numero">Numero:</label>
    <input type="number" id="numero" name="numero" required><br><br>

    <label for="casaID">ID Casa Automobilistica:</label>
    <input type="number" id="casaID" name="casaID"><br><br>

    <button type="submit">Aggiungi Pilota</button>
</form>
</body>
</html>

