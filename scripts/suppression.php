<?php session_start();
//  Requete de suppression de tâche et des affectations qui y sont lié
if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && isset($_POST['id']))
{

    $idTache = $_POST['id'];    //  Récupération de l'ID de la tâche

    include('connexionbdd.php');    //  Connexion à la base
    
    //  Suppression des tâches
    $sql = 'DELETE FROM taches '
            . 'WHERE id = :tache_id';

    $stmt = $pdo->prepare($sql); //  Préparation de la requete
    $stmt->bindValue(':tache_id', $idTache);

    $result = $stmt->execute(); //  Execution de la requete et récupération du résultat de la requete

    if($result)
    {
        //  Suppression des affectations
        $sqldeux = 'DELETE FROM affecter '
                    . 'WHERE tache_id = :idtache';

        $stmtdeux = $pdo->prepare($sqldeux);     
        $stmtdeux->bindValue(':idtache', $idTache);

        $resultdeux = $stmtdeux->execute(); 

        if($resultdeux)
        {
            echo 'ok';  //  Chaine à retourner (qui sera utilisé dans le fichier main.js) si la suppression est effectué avec succès
        }
        else
        {
            echo 'pas ok';  //  Chaine à retourner en cas d'erreur
        }

    }
    else
    {

        echo 'pas ok'; 

    }

}
else
{

    header('location: index.php');


}