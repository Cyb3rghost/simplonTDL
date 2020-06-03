<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && isset($_POST['id']))
{

    $idTache = $_POST['id'];

    $pdo = new PDO('sqlite:../simplonn.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
    

    $sql = 'DELETE FROM taches '
            . 'WHERE id = :tache_id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':tache_id', $idTache);

    $result = $stmt->execute();

    if($result)
    {

        $sqldeux = 'DELETE FROM affecter '
                    . 'WHERE user_id = :iduser AND tache_id = :idtache';

        $stmtdeux = $pdo->prepare($sqldeux);
        $stmtdeux->bindValue(':iduser', $_SESSION['id']);
        $stmtdeux->bindValue(':idtache', $idTache);

        $resultdeux = $stmtdeux->execute();

        if($resultdeux)
        {
            header('location: ../dashboard.php');
        }
        else
        {
            header('location: ../dashboard.php');
        }

    }
    else
    {

        header('location: ../dashboard.php');

    }

}
else
{

    header('location: index.php');


}