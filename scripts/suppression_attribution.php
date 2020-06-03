<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && !empty($_POST['id']))
{

    $idAffectation = $_POST['id'];

    $pdo = new PDO('sqlite:../simplonn.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT

    $stmt = $pdo->prepare('DELETE FROM affecter WHERE id = :id');
    $stmt->bindValue(':id', $idAffectation);

    $result = $stmt->execute();

    if($result)
    {

            //header('location: ../dashboard.php');
        echo 'ok';
    }else{
            //header('location: ../dashboard.php');
        echo 'pas ok';
    }

}
else
{

    header('location: index.php');


}
