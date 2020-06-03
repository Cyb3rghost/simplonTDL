<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && isset($_GET['idtache']) && isset($_GET['iduser']))
{

    $idTache = $_GET['idtache'];
    $idUser = $_GET['iduser'];
    $proprietaire = 0;

    $pdo = new PDO('sqlite:../simplonn.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
    

    $stmt = $pdo->prepare("SELECT count(*) FROM affecter WHERE user_id = ? AND tache_id = ?");
    $stmt->execute([ $idUser, $idTache]);
    $count = $stmt->fetchColumn();

    if($count > 0)
    {

        // SI EXISTE ON CREER PAS ON RENVOIE SUR LA PAGE DASHBOARD
        echo "L'affection existe déjà.";

    }
    else
    {

        // SI EXISTE PAS ON CREER
        $stmtdeux = $pdo->prepare("INSERT INTO affecter (user_id,tache_id, proprietaire) VALUES (:userid,:tacheid,:proprietaire);");

        $stmtdeux->bindParam(':userid', $idUser);
        $stmtdeux->bindParam(':tacheid', $idTache);
        $stmtdeux->bindParam(':proprietaire', $proprietaire);
    
        $resultdeux = $stmtdeux->execute();

        if($resultdeux)
        {

            header('location: ../dashboard.php');

        }
        else
        {

            header('location: ../dashboard.php');

        }

    }


}
else
{

    header('location: index.php');

}