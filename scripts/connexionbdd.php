<?php 
//fichier de connexion à la base de donnée //
$pdo = new PDO('sqlite:../simplonn.db'); // on donne le chemin d'accès //
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT

?>