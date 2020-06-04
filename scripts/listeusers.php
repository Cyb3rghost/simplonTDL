<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo'])) // si la personne est connectée alors //
{
    //inclue fichier de connection à la base de données
    include('connexionbdd.php');
    
    //préparation de la requete
    $stmt = $pdo->prepare("SELECT id, nom FROM users");
    //execution de la requete
    $stmt->execute();
    //creation d'un tableau qui recuperera les données la requetes
    $arr_res = array();
    $erreur = 0;    //  Variable qui sera exploité du côté du fichier server.php pour savoir s'il y eu une erreur ou pas (valeur 0 indique pas d'erreur et 1 indiqu'il y a eu d'erreur)
    //insertion des données dans le tableau
    foreach ($stmt as $row) {    
        array_push($arr_res, array('id' => $row['id'],'nom' => $row['nom']));    
    }
}
else
{
    $erreur = 1;  
}
