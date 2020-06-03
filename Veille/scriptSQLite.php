<?php

try{
    $pdo = new PDO('sqlite:C:/xampp/htdocs/simplon/TodoList/simplonn.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT

    if ($pdo){
    echo "Connecté à la base de donnée SQLite. <br/><br/>";
    }
    else {
    echo "Erreur de connexion à la base de donnée SQLite. <br/><br/>";
    }

    //INSERT
    /*$idName = 2;
    $taskName = "TestingDeux";
    $statutName = '0';
    
    $stmt = $pdo->prepare("INSERT INTO taches (id,taches,etat) VALUES (:id,:taches,:etat);");

    $stmt->bindParam(':id', $idName);
    $stmt->bindParam(':taches', $taskName);
    $stmt->bindParam(':etat', $statutName);

    $result = $stmt->execute();
    
    return $pdo->lastInsertId();*/

    // SELECT
    $result = $pdo->query('SELECT * FROM users');

    foreach ($result as $row) {
        # code...

        echo "ID : ".$row['id']."<br/>";
        echo "Taches : ".$row['nom']."<br/>";
        echo "Password : ".$row['password']."<br/>";
        echo "------------------------------------- <br/>";

    }

    // UPDATE

    /*$id = 2;
    $majData = "TestMiseAJour";
    $majStatus = 1;

    $stmt = $pdo->prepare("UPDATE taches 
        SET taches=:taches, 
            etat=:uptetat 
        WHERE (id=2)"
    );

    $stmt->bindParam(':taches', $majData);
    $stmt->bindParam(':uptetat', $majStatus);

    $result = $stmt->execute();*/

    //$result->exec();

    // DELETE 
    /*$sql = 'DELETE FROM taches '
            . 'WHERE id = :tache_id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':tache_id', 2);

    $stmt->execute();*/

} catch(Exception $e) {
    echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
    die();
}



