<?php
$host = 'localhost';
$dbname = 'campionato';
$username = 'root';
$password = '';

try {
    $db = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

        ]
    );
} catch (PDOException $e) {
    die('Errore di connessione al database: ' . $e->getMessage());
}
?>