<?php session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']))
{



    echo "Bienvenue, ".$_SESSION['pseudo']." sur votre espace personnel. <a href='scripts/deconnexion.php'>Déconnexion</a>";




}
else
{

    header('Location: index.php');

}
?>