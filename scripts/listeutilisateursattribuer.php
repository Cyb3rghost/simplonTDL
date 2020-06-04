<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && isset($_POST['idtache']) && isset($_POST['iduser']))
{

    $idTache = $_POST['idtache'];
    $idUser = $_POST['iduser'];

    $pdo = new PDO('sqlite:../simplonn.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
    
    $stmt = $pdo->prepare("SELECT users.nom FROM affecter INNER JOIN users ON users.id = affecter.user_id WHERE user_id = :userid AND tache_id = :idtache");
    $stmt->bindValue(':userid', $idUser);
    $stmt->bindValue(':idtache', $idTache);
    $stmt->execute();

    foreach ($stmt as $row) { 

        echo $row['nom'];

    }
    
}
else
{

    header('location: index.php');

}