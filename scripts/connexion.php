<?php 

if(!empty($_POST['username']) && !empty($_POST['password'])) // ON VERIFIE SI LES CHAMPS USERNAME ET PASSWORD SONT DIFFERENT DE VIDE
{

    $username =htmlentities($_POST['username']); // ON RECUPERE LE CONTENU DU CHAMP USERNAME ET ON LE PROTEGE CONTRE LE XSS
    $password = htmlentities($_POST['password']); // ON RECUPERE LE CONTENU DU CHAMP PASSWORD ET ON LE PROTEGE CONTRE LE XSS    
    $secure = md5($password); // ON CRYPT LA VARIABLE PASSWORD EN MD5
    $count = 0; // ON INITIALISE LA VARIABLE COUNT A 0

    try{
        include('connexionbdd.php'); // ON INCLUE LE FICHIER DE CONNEXION BDD QUI GERE LA CONNEXION A LA BASE DE DONNEE
    
        if ($pdo){ // SI IL Y A UNE CONNEXION 

            $sql = "SELECT * FROM users WHERE nom = :name AND password = :pass"; // ON ENFERME DANS UNE VARIABLE LA REQUETE 
            $statement = $pdo->prepare($sql); // ON PREPARE LA REQUETE
            $statement->execute(array(':name' => $username, ':pass' => $secure)); // ON EXECUTE LA REQUETE EN PASSANT LES PARAMETRES USERNAME ET SECURE
            $row = $statement->fetch(); // ON RECUPERE LES DONNEES
            
                if ($row['nom'] === $username && $row['password'] === $secure){ // SI LE CHAMP NOM ET LE CHAMP PASSWORD CORRESPOND AU VARIABLE USERNAME ET SECURE

                    session_start();   // ON DEMARRE UNE SESSION
                    $_SESSION['id']=$row['id']; // ON ENFERME LA DATA ID RECUPERER DANS LA SESSION ID
                    $_SESSION['pseudo']=$row['nom']; // ON ENFERME LA DATA NOM RECUPERER DANS LA SESSION NOM

                    echo 'ok'; //  La variable valide est définie dans le fichier "server.php"

                }else{
                    echo "Connexion impossible. [Nom d'utilisateur / Password incorrect]"; // ON RENVOIE CONNEXION IMPOSSIBLE
                }   
        }
        else {
        echo "Erreur de connexion à la base de donnée SQLite. <br/><br/>"; // ON RENVOIE ERREUR DE CONNEXION A LA BDD SI PROBLEME
        }

    } catch(Exception $e) {
        echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage(); // ON RENVOIE UN MESSAGE DERREUR SI ON PEUT PAS ACCEDER A LA BASE DE DONNEE
        die(); // ON COUPE LE SCRIPT
    }  

}

?>