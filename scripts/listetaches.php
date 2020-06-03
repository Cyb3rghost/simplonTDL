<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']))
{

    $pdo = new PDO('sqlite:../simplonn.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
    
    $stmt = $pdo->prepare("SELECT taches.id,user_id,tache,etat FROM affecter INNER JOIN taches ON taches.id = affecter.tache_id WHERE user_id = :userid");
    $stmt->bindValue(':userid', $_SESSION['id']);
    $stmt->execute();
    
    
    foreach ($stmt as $row) {
        # code...
    
        echo "ID : ".$row['id']."<br/>";
        echo "Tache : ".$row['tache']."<br/>";
        echo "Etat : ".$row['etat']."<br/>";
        echo "------------------------------------- <br/>";
    
    }

}
else
{

    header('Location: ../index.php');

}