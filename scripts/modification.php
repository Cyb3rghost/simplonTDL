<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && isset($_POST['tache']))
{
 
    include('connexionbdd.php');

    
    $tache = $_POST['tache'];
    $proprietaire = 1;
    $id =  $_POST['id'];

    $stmt = $pdo->prepare("UPDATE taches SET tache=:tache WHERE id=:id");

    $stmt->bindParam(':tache', $tache);
    $stmt->bindParam(':id', $id);

    $result = $stmt->execute();

    if($result)
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
