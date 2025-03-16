<?php
require 'header.php';
require 'db.php';

$query = 'SELECT G.Data, G.Circuito, P.Nome, P.Cognome, G.Posizione, G.TempoMigliore
          FROM Gara G
          JOIN Piloti P ON G.PilotaID = P.PilotaID
          ORDER BY G.Data, G.Posizione';

$risultati = $db->query($query);
?>

<h1>Risultati delle Gare</h1>
<table>
    <thead>
    <tr>
        <th>Data</th>
        <th>Circuito</th>
        <th>Pilota</th>
        <th>Posizione</th>
        <th>Tempo Migliore</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($risultati as $gara): ?>
        <tr>
            <td><?= htmlspecialchars($gara['Data']) ?></td>
            <td><?= htmlspecialchars($gara['Circuito']) ?></td>
            <td><?= htmlspecialchars($gara['Nome'] . ' ' . $gara['Cognome']) ?></td>
            <td><?= htmlspecialchars($gara['Posizione']) ?></td>
            <td><?= htmlspecialchars($gara['TempoMigliore']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require 'footer.php'; ?>
