<?php
require 'header.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $nazionalita = $_POST['nazionalita'];
    $numero = $_POST['numero'];
    $casaID = $_POST['casa_id'];

    // 1. Verifica se esiste già un pilota con lo stesso nome, cognome e numero
    $checkPilota = 'SELECT * FROM Piloti WHERE Nome = :nome AND Cognome = :cognome AND Numero = :numero';
    $stmtCheckPilota = $db->prepare($checkPilota);
    $stmtCheckPilota->bindParam(':nome', $nome);
    $stmtCheckPilota->bindParam(':cognome', $cognome);
    $stmtCheckPilota->bindParam(':numero', $numero);
    $stmtCheckPilota->execute();

    // Se il pilota esiste già, mostra un messaggio di errore
    if ($stmtCheckPilota->rowCount() > 0) {
        echo "<p>Errore: esiste già un pilota con lo stesso nome, cognome e numero!</p>";
    } else {
        // 2. Se non esistono duplicati, esegui l'inserimento
        $query = 'INSERT INTO Piloti (Nome, Cognome, Nazionalità, Numero, CasaID) VALUES (:nome, :cognome, :nazionalita, :numero, :casa_id)';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cognome', $cognome);
        $stmt->bindParam(':nazionalita', $nazionalita);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':casa_id', $casaID);

        if ($stmt->execute()) {
            echo "<p>Pilota aggiunto con successo!</p>";
        } else {
            echo "<p>Errore durante l'inserimento del pilota.</p>";
        }
    }
}
?>

<h1>Inserisci un nuovo pilota</h1>
<form method="POST" action="creazionePilota.php">
    <label>Nome:</label> <input type="text" name="nome" required><br>
    <label>Cognome:</label> <input type="text" name="cognome" required><br>
    <label>Nazionalità:</label> <input type="text" name="nazionalita" required><br>
    <label>Numero:</label> <input type="number" name="numero" required><br>
    <label>Squadra:</label>
    <select name="casa_id" required>
        <?php
        $squadre = $db->query('SELECT CasaID, Nome FROM CasaAutomobilistica');
        foreach ($squadre as $squadra) {
            echo "<option value='{$squadra['CasaID']}'>{$squadra['Nome']}</option>";
        }
        ?>
    </select><br>
    <button type="submit">Aggiungi Pilota</button>
</form>

<?php require 'footer.php'; ?>
