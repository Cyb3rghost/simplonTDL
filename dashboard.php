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
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	    <link rel="stylesheet" href="CSS/style.css">
        <link rel="icon" href="image/test.png" />
    <!-- JS, Popper.js, and jQuery -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://kit.fontawesome.com/6bffc813f0.js" crossorigin="anonymous"></script>
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
<div class="flex">
<img src="image/d739fc1c-f8f3-4e8f-8f02-d5ca0da3c533_200x200%20(1).png" alt="">
</div>
        <button type="button" class="btn btn-primary test" data-toggle="modal" data-target="#exampleModal" >ajouter un TODO </button>
<!-- La modal pour ajouter un TODO -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Créer un TODO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea class="form-control tache" id="exampleFormControlTextarea1" rows="3" placeholder="..."></textarea>
            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary btn_valider_aj">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- la modal pour assigner un todo-->

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Attribuer un TODO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">

                <select class="custom-select" id="liste_u">
                    <option selected>Attribuer à un utilisateur</option>
                    <!-- Zone d'affichage de la liste des utilisateur -->
                </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>


<!-- la modal pour modifier un todo-->

<div class="modal fade" id="exampleModalLabelModif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier le TODO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="..."></textarea>

                </div>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="flex">

<div class="read">	<?php
    echo "<div style='text-align: center; height: 50px'> <h2>TODOList de ".$_SESSION['pseudo']." : </h2></div>";
    ?>
<div class="flex">
    <ul class='liste_tache' style="  list-style-type: none">
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