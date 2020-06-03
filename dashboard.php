<?php 
session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']))
{
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    <title>TODO List</title>

	<!-- bootstrapp-->
	    <!-- CSS only -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	    <link rel="stylesheet" href="CSS/style.css">
	    <!-- JS, Popper.js, and jQuery -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	    <script type="text/javascript" src="js/main.js"></script>
	</head>
	<body>
		<?php
			echo "<div style='text-align: center'>Bienvenue, ".$_SESSION['pseudo']." sur votre espace personnel. <a href='scripts/deconnexion.php'>Déconnexion</a></div>";
		?>
	<h1 style="text-align: center">Voici votre TODO List </h1>

	<!-- La modal pour ajouter un TODO -->
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
	                <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="TODO 1">
	            </div>
	            <div class="input-group mb-3">
	                <select class="custom-select" id="liste_u">
	                    <option selected>Attribuer à un utilisateur</option>
	                    <!-- Zone d'affichage de la liste des utilisateur -->
	                </select>

	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
	                <button type="button" class="btn btn-primary btn_valider_aj">Submit</button>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="flex">

	<div class="read">

	    <div style="text-align: center"> <h2>ajouter un TODO  : <button type="button" class="btn btn-primary btn_ajout_t" data-toggle="modal" data-target="#exampleModal">ajouter</button></h2></div>

	    <ul class='liste_tache'>
	        <!-- Zone d'affichage de la liste des tâches -->
	    </ul>
	</div>
	</div>

	</body>
	</html>
<?php
}
else
{
    header('Location: index.php');

}
?>