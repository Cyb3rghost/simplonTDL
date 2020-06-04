<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && isset($_POST['tache']))
{
 
    include('connexionbdd.php');

    
    $tache = htmlentities($_POST['tache']);
    $proprietaire = 1;
    $etat = 0;

    $stmt = $pdo->prepare("INSERT INTO taches (tache,etat) VALUES (:tache,:etat);");

    $stmt->bindParam(':tache', $tache);
    $stmt->bindParam(':etat', $etat);

    $result = $stmt->execute();

    $dernierIDAjouter = $pdo->lastInsertId();
    $idUtilisateur = $_SESSION['id'];

    $stmtdeux = $pdo->prepare("INSERT INTO affecter (user_id,tache_id, proprietaire) VALUES (:userid,:tacheid,:proprietaire);");

    $stmtdeux->bindParam(':userid', $idUtilisateur);
    $stmtdeux->bindParam(':tacheid', $dernierIDAjouter);
    $stmtdeux->bindParam(':proprietaire', $proprietaire);

    $resultdeux = $stmtdeux->execute();

    if($resultdeux)
    {
        // header('location: ../dashboard.php');
        echo "ok";
    }
    else
    {
        echo "Une erreur est survenue lors de la création de la tâche.";
        // header('location: ../dashboard.php');
    }

}
else
{
    header('Location: ../index.php');
}

?>