<?php 
session_start();  
//  Requete de suppression d'une attribution
if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && !empty($_POST['id'])) 
{

    $idAffectation = $_POST['id'];  //  Récupération de l'ID de l'affectation

    include('connexionbdd.php');    //  Connexion à la base de données

    $stmt = $pdo->prepare('DELETE FROM affecter WHERE id = :id');   //  Préparation de la requete
    $stmt->bindValue(':id', $idAffectation);

    $result = $stmt->execute(); //  Execution de la requete et récupération du résultat de la requete

    if($result)
    {
        echo 'ok';  //  Chaine à retourner (qui sera utilisé dans le fichier main.js) si la suppression est effectué avec succès
    }else{        
        echo 'pas ok';  //  Chaine à retourner en cas d'erreur
    }

}
else
{

    header('location: index.php');  //  Retour à la page de connexion si l'utilisateur n'est pas connécté


}
