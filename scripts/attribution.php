<?php session_start(); // ON DEMARRE UNE SESSION

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && isset($_POST['idtache']) && isset($_POST['iduser'])) // ON VERIFIE QUE LES SESSION ID ET PSEUDO SONT PAS VIDE ET ON VERIFIE SI LES CHAMP RECUPERER EN POST IDTACHE ET IDUSER EXISTENT
{

    $idTache = $_POST['idtache']; // ON RECUPERE LE CHAMP IDTACHE
    $idUser = $_POST['iduser']; // ON RECUPERE LE CHAMP IDUSER
    $proprietaire = 0; // ON CREER UNE VARIABLE PROPRIETAIRE 

    include('connexionbdd.php'); // ON INCLUE LE FICHIER DE CONNEXION BDD QUI GERE LA CONNEXION A LA BASE DE DONNEE

    $stmt = $pdo->prepare("SELECT count(*) FROM affecter WHERE user_id = ? AND tache_id = ?"); // ON PREPARE LA REQUETE QUI VA PERMETTRE DE COMPTER SI LE NOMBRE DE LIGNE CORRESPONDANTE A LUSER ID ET LA TACHE ID
    $stmt->execute([ $idUser, $idTache]); // ON EXECUTE LA REQUETE PREPARER
    $count = $stmt->fetchColumn(); // ON COMPTE LE NOMBRE DE COLONNE

    if($count > 0) // ON VERIFIE SI LA VARAIBLE COUNT EST SUPERIEUR A 0
    {

        // SI EXISTE ON CREER PAS ON RENVOIE SUR LA PAGE DASHBOARD
        echo "L'affection existe déjà.";

    }
    else
    {

        // SI EXISTE PAS ON CREER
        $stmtdeux = $pdo->prepare("INSERT INTO affecter (user_id,tache_id, proprietaire) VALUES (:userid,:tacheid,:proprietaire);"); // ON PREPARE LA REQUETE DINSERTION A LA TABLE AFFECTER.

        $stmtdeux->bindParam(':userid', $idUser); // ON ASSOCIE LA VARIABLE IDUSER AU PARAMETRE :USERID
        $stmtdeux->bindParam(':tacheid', $idTache); // ON ASSOCIE LA VARIABLE IDTACHE AU PARAMETRE :TACHEID
        $stmtdeux->bindParam(':proprietaire', $proprietaire); // ON ASSOCIE LA VARAIBLE PROPRIETAIRE AU PARAMETRE :PROPRIETAIRE
    
        $resultdeux = $stmtdeux->execute(); // ON EXECUTE LA REQUETE

        if($resultdeux) // SI LA REQUETE EST EXECUTE
        {

            echo 'ok'; // ON ENVOIE LINFORMATION OK

        }
        else
        {

            echo 'Echec d\'attribution de la tâche'; // ON ENVOIE LINFORMATION EST PAS OK

        }

    }


}
else
{

    header('location: index.php'); // ON RENVOIE SUR LA PAGE PRINCIPALE SUR LA PAGE INDEX

}