<?php
// Include la connessione al database
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ottieni i dati dal modulo
    $nome = $_POST['nome'];
    $coloreLivrea = $_POST['coloreLivrea'];

    // Connessione al database
    $database = new Database();
    $conn = $database->getConnection();

    // Query per inserire la scuderia
    $query = "INSERT INTO CasaAutomobilistica (Nome, ColoreLivrea) VALUES (:nome, :coloreLivrea)";
    $stmt = $conn->prepare($query);

    // Associa i parametri
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':coloreLivrea', $coloreLivrea);

    try {
        // Esegui la query
        $stmt->execute();
        echo "Scuderia inserita con successo!";
    } catch (PDOException $e) {
        echo "Errore nell'inserimento della scuderia: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci Scuderia</title>
</head>
<body>
<h1>Inserisci una nuova Scuderia</h1>
<form action="inserisci_scuderia.php" method="POST">
    <label for="nome">Nome Scuderia:</label>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="coloreLivrea">Colore Livrea:</label>
    <input type="text" id="coloreLivrea" name="coloreLivrea" required><br><br>

    <button type="submit">Aggiungi Scuderia</button>
</form>
</body>
</html>
