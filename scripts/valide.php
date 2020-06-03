<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && isset($_POST['id']))
{

    $idTache = $_POST['id'];

    $pdo = new PDO('sqlite:../simplonn.db');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
    
    //$result = $pdo->query('SELECT * FROM taches WHERE id = 2');

    $stmt = $pdo->prepare("SELECT count(*) FROM taches WHERE id = ?");
    $stmt->execute([$idTache]);
    $count = $stmt->fetchColumn();

    if($count > 0)
    {

        $stmtdeux = $pdo->prepare("SELECT * FROM taches WHERE id = :idtache");
        $stmtdeux->bindValue(':idtache', $idTache);
        $stmtdeux->execute();

        //echo $stmt->rowCount();

        foreach ($stmtdeux as $item) {
            # code...

            if($item['etat'] === "1")
            {

                $etat = 0;

                $stmtrois = $pdo->prepare("UPDATE taches 
                    SET etat=:uptetat 
                    WHERE (id=:idtache)"
                );
            
                $stmtrois->bindParam(':uptetat', $etat);
                $stmtrois->bindParam(':idtache', $idTache);
            
                $result = $stmtrois->execute();

                if($result)
                {

                    echo "Est pas terminer.";

                }


            }
            else
            {

                $etat = 1;

                $stmtrois = $pdo->prepare("UPDATE taches 
                    SET etat=:uptetat 
                    WHERE (id=:idtache)"
                );
            
                $stmtrois->bindParam(':uptetat', $etat);
                $stmtrois->bindParam(':idtache', $idTache);

                $result = $stmtrois->execute();

                if($result)
                {

                    echo "Est terminé.";

                }


            }

            /*echo $item['id']."<br/>";
            echo $item['tache']."<br/>";*/

        }

        //echo "Existe !";

    }
    else
    {

        echo "Existe pas !";

    }

    
}
else
{
    $erreur = 1;  //    Vari
}