<?php
require_once 'Database.php';

if (isset($_GET['garaID'])) {
    $garaID = $_GET['garaID'];

    $database = new Database();
    $conn = $database->getConnection();

    $query = "SELECT p.Nome, p.Cognome, g.Posizione, g.TempoMigliore 
              FROM Gara g 
              JOIN Piloti p ON g.PilotaID = p.PilotaID 
              WHERE g.GaraID = :garaID 
              ORDER BY g.Posizione ASC";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":garaID", $garaID);
    $stmt->execute();

    $risultati = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($risultati);
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultati Gara</title>
    <script>
        async function getRisultati() {
            const garaID = document.getElementById('garaID').value;
            const response = await fetch(`risultati_gara.php?garaID=${garaID}`);
            const risultati = await response.json();

            const table = document.getElementById('risultati-table');
            table.innerHTML = ''; // Pulisce la tabella

            risultati.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td>${row.Nome}</td><td>${row.Cognome}</td><td>${row.Posizione}</td><td>${row.TempoMigliore}</td>`;
                table.appendChild(tr);
            });
        }
    </script>
</head>
<body>
<h1>Risultati di una Gara</h1>
<label for="garaID">ID Gara:</label>
<input type="number" id="garaID" name="garaID">
<button onclick="getRisultati()">Mostra Risultati</button>
<br><br>
<table border="1">
    <thead>
    <tr>
        <th>Nome</th>
        <th>Cognome</th>
        <th>Posizione</th>
        <th>Tempo Migliore</th>
    </tr>
    </thead>
    <tbody id="risultati-table"></tbody>
</table>
</body>
</html>
