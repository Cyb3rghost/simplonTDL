<?php session_start(); // ON DEMARRE LA SESSION

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && isset($_POST['tache'])) // ON VERIFIE QUE LES SESSIONS STOCKER A LA CONNEXION EXISTE ET QUE LA VARIABLE POST TACHE EXISTE
{
 
    include('connexionbdd.php'); // ON INCLUE LE SCRIPT DE CONNEXION

    
    $tache = htmlentities($_POST['tache']); // ON RECUPERE LA VARIABLE TACHE EN POST ET ON PROTEGE CONTRE LA FAILLE XSS AVEC HTML ENTITIES
    $proprietaire = 1; // ON DECLARE LA VARIABLE PROPRIETAIRE A 1
    $etat = 0; // ON DECLARE LA VARIABLE ETAT A 0

    $stmt = $pdo->prepare("INSERT INTO taches (tache,etat) VALUES (:tache,:etat);"); // ON PREPARE LA REQUETE D'INSERTION

    $stmt->bindParam(':tache', $tache); // ON ASSOCIE LA VARIABLE TACHE AU PARAMETRE :tache de la requête PREPARER
    $stmt->bindParam(':etat', $etat); // ON ASSOCIE LA VARIABLE ETAT AU PARAMETRE :etat de la requête PREPARER

    $result = $stmt->execute(); // ON EXECUTE LA REQUETE

    $dernierIDAjouter = $pdo->lastInsertId(); // ON ENFERME DANS UNE VARIABLE LE DERNIER ID ENREGISTRER EN BDD
    $idUtilisateur = $_SESSION['id']; // ON ENFERME DANS UNE VARIABLE L'ID DE L'UTILISATEUR CONNECTER

    $stmtdeux = $pdo->prepare("INSERT INTO affecter (user_id,tache_id, proprietaire) VALUES (:userid,:tacheid,:proprietaire);"); // ON PREPARE LA REQUETE D'INSERTION DE L'AFFECTATION PROPRIETAIRE

    $stmtdeux->bindParam(':userid', $idUtilisateur);  // ON ASSOCIE LA VARIABLE USERID AU PARAMETRE :userid
    $stmtdeux->bindParam(':tacheid', $dernierIDAjouter); // ON ASSOCIE LA VARIABLE TACHEID AU PARAMETRE :tacheid
    $stmtdeux->bindParam(':proprietaire', $proprietaire); // ON ASSOCIE LA VARIABLE PROPRIETAIRE AU PARAMETRE :proprietaire

    $resultdeux = $stmtdeux->execute(); // ON EXECUTE LA DEUXIEME REQUETE

    if($resultdeux) // SI LA DEUXIEME REQUETE EST BIEN EXECUTER
    {
        echo "ok"; // ON RETOURNE OK
    }
    else
    {
        echo "Une erreur est survenue lors de la création de la tâche."; // ON RETOURNE UNE ERREUR EST SURVENUE.
    }

}
else // SINON
{
    header('Location: ../index.php'); // ON RENVOIE A LA PAGE D'ACCUEIL SI L'UTILISATEUR N'EST PAS CONNECTER.
}

?>