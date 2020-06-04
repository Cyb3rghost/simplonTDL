<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']))
{

    include('connexionbdd.php');
    
    $stmt = $pdo->prepare("SELECT id, nom FROM users");
    $stmt->execute();
    $arr_res = array();
    $erreur = 0;    //  Variable qui sera exploité du côté du fichier server.php pour savoir s'il y eu une erreur ou pas (valeur 0 indique pas d'erreur et 1 indiqu'il y a eu d'erreur)
    foreach ($stmt as $row) {    
        array_push($arr_res, array('id' => $row['id'],'nom' => $row['nom']));    
    }
    // var_dump($arr_res);
}
else
{
    $erreur = 1;  
}