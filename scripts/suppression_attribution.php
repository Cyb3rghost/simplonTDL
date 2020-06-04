<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && !empty($_POST['id']))
{

    $idAffectation = $_POST['id'];

    include('connexionbdd.php');

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
