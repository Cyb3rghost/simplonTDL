<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']))
{

    include('connexionbdd.php');
    
    $stmt = $pdo->prepare("SELECT taches.id,user_id,tache,etat,proprietaire FROM affecter INNER JOIN taches ON taches.id = affecter.tache_id WHERE user_id = :userid");
    $stmt->bindValue(':userid', $_SESSION['id']);
    $stmt->execute();
    $arr_res = array();
    $erreur = 0;    //  Variable qui sera exploité du côté du fichier server.php pour savoir s'il y eu une erreur ou pas (valeur 0 indique pas d'erreur et 1 indiqu'il y a eu d'erreur)
    foreach ($stmt as $row) {    
        array_push($arr_res, array('id' => $row['id'],'tache' => $row['tache'],'etat' => $row['etat'], 'id_prop' => $row['proprietaire']));    
    }
}
else
{
    $erreur = 1;  //    Vari
}