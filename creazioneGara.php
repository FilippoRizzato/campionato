<?php
/*require 'header.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['data'];
    $circuito = $_POST['circuito'];
    $pilotaID = $_POST['pilota_id'];
    $posizione = $_POST['posizione'];
    $tempo = $_POST['tempo'];

    $query = 'INSERT INTO Gara (Data, Circuito, PilotaID, Posizione, TempoMigliore) VALUES (:data, :circuito, :pilota_id, :posizione, :tempo)';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':circuito', $circuito);
    $stmt->bindParam(':pilota_id', $pilotaID);
    $stmt->bindParam(':posizione', $posizione);
    $stmt->bindParam(':tempo', $tempo);

    if ($stmt->execute()) {
        echo "<p>Risultato della gara registrato con successo!</p>";
    } else {
        echo "<p>Errore durante l'inserimento del risultato della gara.</p>";
    }
}
?>

<h1>Inserisci una nuova gara</h1>
<form method="POST" action="creazioneGara.php">
    <label>Data:</label> <input type="date" name="data" required><br>
    <label>Circuito:</label> <input type="text" name="circuito" required><br>
    <label>Pilota:</label>
    <select name="pilota_id" required>
        <?php
        $piloti = $db->query('SELECT PilotaID, Nome, Cognome FROM Piloti');
        foreach ($piloti as $pilota) {
            echo "<option value='{$pilota['PilotaID']}'>{$pilota['Nome']} {$pilota['Cognome']}</option>";
        }
        ?>
    </select><br>
    <label>Posizione Finale:</label> <input type="number" name="posizione" required><br>
    <label>Tempo Migliore (HH:MM:SS):</label> <input type="time" step="1" name="tempo" required><br>
    <button type="submit">Aggiungi Risultato della Gara</button>
</form>

<?php require 'footer.php'; */

require 'header.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['data'];
    $circuito = $_POST['circuito'];
    $pilotaID = $_POST['pilota_id'];
    $posizione = $_POST['posizione'];
    $tempo = $_POST['tempo'];

    // 1. Verifica se il pilota ha già una posizione registrata nella stessa data
    $checkPilota = 'SELECT * FROM Gara WHERE Data = :data AND PilotaID = :pilota_id';
    $stmtCheckPilota = $db->prepare($checkPilota);
    $stmtCheckPilota->bindParam(':data', $data);
    $stmtCheckPilota->bindParam(':pilota_id', $pilotaID);
    $stmtCheckPilota->execute();

    if ($stmtCheckPilota->rowCount() > 0) {

        echo "<p>Errore: il pilota ha già una posizione registrata per questa data!</p>";
    } else {
        // 2. Verifica se la posizione è già stata occupata da un altro pilota nella stessa data
        $checkPosizione = 'SELECT * FROM Gara WHERE Data = :data AND Posizione = :posizione';
        $stmtCheckPosizione = $db->prepare($checkPosizione);
        $stmtCheckPosizione->bindParam(':data', $data);
        $stmtCheckPosizione->bindParam(':posizione', $posizione);
        $stmtCheckPosizione->execute();

        if ($stmtCheckPosizione->rowCount() > 0) {
            // Se la posizione è già occupata, invia un messaggio di errore
            echo "<p>Errore: la posizione $posizione è già stata occupata da un altro pilota per questa data!</p>";
        } else {
            // Se non ci sono duplicati, procedi con l'inserimento
            $query = 'INSERT INTO Gara (Data, Circuito, PilotaID, Posizione, TempoMigliore) VALUES (:data, :circuito, :pilota_id, :posizione, :tempo)';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':data', $data);
            $stmt->bindParam(':circuito', $circuito);
            $stmt->bindParam(':pilota_id', $pilotaID);
            $stmt->bindParam(':posizione', $posizione);
            $stmt->bindParam(':tempo', $tempo);

            if ($stmt->execute()) {
                echo "<p>Risultato della gara registrato con successo!</p>";
            } else {
                echo "<p>Errore durante l'inserimento del risultato della gara.</p>";
            }
        }
    }
}
?>

<h1>Inserisci una nuova gara</h1>
<form method="POST" action="creazioneGara.php">
    <label>Data:</label> <input type="date" name="data" required><br>
    <label>Circuito:</label> <input type="text" name="circuito" required><br>
    <label>Pilota:</label>
    <select name="pilota_id" required>
        <?php
        $piloti = $db->query('SELECT PilotaID, Nome, Cognome FROM Piloti');
        foreach ($piloti as $pilota) {
            echo "<option value='{$pilota['PilotaID']}'>{$pilota['Nome']} {$pilota['Cognome']}</option>";
        }
        ?>
    </select><br>
    <label>Posizione Finale:</label> <input type="number" name="posizione" required><br>
    <label>Giro Veloce :</label> <input type="time" step="1" name="tempo" required><br>
    <button type="submit">Aggiungi Risultato </button>
</form>

<?php require 'footer.php'; ?>