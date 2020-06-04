<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && isset($_POST['idtache']))
{

    $idTache = $_POST['idtache'];

    $pdo = new PDO('sqlite:../simplonn.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
    
    $stmt = $pdo->prepare("SELECT users.nom as nom, affecter.id as id_affectation FROM affecter INNER JOIN users ON users.id = affecter.user_id WHERE tache_id = :idtache");
    $stmt->bindValue(':idtache', $idTache);
    $stmt->execute();

    // foreach ($stmt as $row) { 

    //     echo $row['nom'];

    // }
    $arr_res = array();
    $erreur = 0;    //  Variable qui sera exploité du côté du fichier server.php pour savoir s'il y eu une erreur ou pas (valeur 0 indique pas d'erreur et 1 indiqu'il y a eu d'erreur)
    foreach ($stmt as $row) {    
        array_push($arr_res, array('id_affectation' => $row['id_affectation'],'nom' => $row['nom']));    
    }
    
}
else
{

    header('location: index.php');

}