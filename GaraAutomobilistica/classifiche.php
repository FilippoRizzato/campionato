<?php
require_once 'db.php';

$database = new Database();
$conn = $database->getConnection();

$query = "SELECT p.Nome, p.Cognome, SUM(g.Posizione) AS PuntiTotali 
          FROM Piloti p 
          JOIN Gara g ON p.PilotaID = g.PilotaID 
          GROUP BY g.PilotaID 
          ORDER BY PuntiTotali ASC";
$stmt = $conn->prepare($query);
$stmt->execute();

$classifica = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($classifica);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classifica Piloti</title>
    <script>
        async function getClassifica() {
            const response = await fetch('classifica_piloti.php');
            const classifica = await response.json();

            const table = document.getElementById('classifica-table');
            classifica.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td>${row.Nome}</td><td>${row.Cognome}</td><td>${row.PuntiTotali}</td>`;
                table.appendChild(tr);
            });
        }
        window.onload = getClassifica;
    </script>
</head>
<body>
<h1>Classifica Generale Piloti</h1>
<table border="1">
    <thead>
    <tr>
        <th>Nome</th>
        <th>Cognome</th>
        <th>Punti Totali</th>
    </tr>
    </thead>
    <tbody id="classifica-table"></tbody>
</table>
</body>
</html>
