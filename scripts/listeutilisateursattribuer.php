<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && isset($_POST['idtache']) && isset($_POST['iduser']))
{

    $idTache = $_POST['idtache'];
    $idUser = $_POST['iduser'];

    include('connexionbdd.php');
    
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