<?php 

if(!empty($_POST['username']) && !empty($_POST['password']))
{

    $username = $_POST['username'];
    $password = $_POST['password'];
    $secure = md5($password);
    $count = 0;

    try{
        $pdo = new PDO('sqlite:../simplonn.db');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
    
        if ($pdo){

            $sql = "SELECT * FROM users WHERE nom = :name AND password = :pass";
            $statement = $pdo->prepare($sql);
            $statement->execute(array(':name' => $username, ':pass' => $secure));
            $row = $statement->fetch();
            
                if ($row['nom'] === $username && $row['password'] === $secure){

                    session_start();   
                    $_SESSION['id']=$row['id'];
                    $_SESSION['pseudo']=$row['nom'];

                    header("Location:../dashboard.php");

                }else{
                    echo "Connexion impossible. [Nom d'utilisateur / Password incorrect]";
                }   

        }
        else {
        echo "Erreur de connexion à la base de donnée SQLite. <br/><br/>";
        }

    } catch(Exception $e) {
        echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
        die();
    }  

}

?>