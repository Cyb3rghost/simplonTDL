<?php session_start();
    //  Récupération de la liste des utilisateurs affecté à une tâches à l'exception du propriétaire s'il est l'utilisateur connécté
if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && isset($_POST['idtache']))
{

    $idTache = $_POST['idtache'];

    //inclue fichier de connection à la base de données
    include('connexionbdd.php');
    
<<<<<<< HEAD
    $stmt = $pdo->prepare("SELECT users.nom as nom, affecter.id as id_affectation FROM affecter INNER JOIN users ON users.id = affecter.user_id WHERE tache_id = :idtache AND affecter.user_id != :id_user");
    $stmt->bindValue(':idtache', $idTache);
    $stmt->bindValue(':id_user', $_SESSION['id']);
    $stmt->execute();
    
=======
    //préparation de la requete
    $stmt = $pdo->prepare("SELECT users.nom as nom, affecter.id as id_affectation FROM affecter INNER JOIN users ON users.id = affecter.user_id WHERE tache_id = :idtache");
    $stmt->bindValue(':idtache', $idTache);
    //execution de la requete
    $stmt->execute();
    //creation d'un tableau qui recuperera les données la requete
>>>>>>> d664a61d834b8cb6ffedaa8bca9b1dcb91730f67
    $arr_res = array();
    $erreur = 0;    //  Variable qui sera exploité du côté du fichier server.php pour savoir s'il y eu une erreur ou pas (valeur 0 indique pas d'erreur et 1 indiqu'il y a eu d'erreur)
    //insertion des données dans le tableau
    foreach ($stmt as $row) {    
        array_push($arr_res, array('id_affectation' => $row['id_affectation'],'nom' => $row['nom']));    
    }
    
}
else
{
    //redirection vers la page de login
    header('location: index.php');

}