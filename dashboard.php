<?php 
session_start();

if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']))
{
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <title>TODO List</title>

	<!-- bootstrapp-->
	    <!-- CSS only -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	    <link rel="stylesheet" href="CSS/style.css">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="icon" href="image/test.png" />
        <!-- jquery-confirm.css-->
        <link rel="stylesheet" href="lib/jquery-confirm/jquery-confirm.css">
        <!-- CSS perso -->
        <link rel="stylesheet" href="CSS/style.css">
    <!-- JS, Popper.js, and jQuery -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://kit.fontawesome.com/6bffc813f0.js" crossorigin="anonymous"></script>
	    <!-- JS, Popper.js, and jQuery -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <!-- jquery-confirm.js-->
        <script type="text/javascript" src="lib/jquery-confirm/jquery-confirm.js"></script>
        <!-- JS perso -->
	    <script type="text/javascript" src="js/main.js"></script>
	</head>
	<body>
		<?php
			echo "<div style='text-align: center'>Bienvenue, ".$_SESSION['pseudo']." sur votre espace personnel. <a href='scripts/deconnexion.php'>Déconnexion</a></div>";
		?>
<div class="flex">
<img src="image/d739fc1c-f8f3-4e8f-8f02-d5ca0da3c533_200x200%20(1).png" alt="">
</div>

<!-- La modal pour ajouter un TODO -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Créer un TODO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea class="form-control tache" id="exampleFormControlTextareaAjoutTache" rows="3" placeholder="..."></textarea>
            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id='btn_valider_aj'>Submit</button>
            </div>
            <div class='text-center mb-3 div_message_modal'></div>
        </div>
    </div>
</div>
<!-- la modal pour assigner un todo-->

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel1">Attribuer un TODO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">

                <select class="custom-select" id="liste_u">
                    <!-- Zone d'affichage de la liste des utilisateurs -->
                </select>
                </div>
                <div class="flex">
                    <ul class='liste_u_aff'>
                        <!-- Zone d'affichage de la liste des utilisateurs affécté -->
                        <li>user1<span class='ml-2 mr-2 badge badge-secondary text-wrap' style="">X</span></li>
                        <li>user2<span class='ml-2 mr-2 badge badge-secondary text-wrap' style="">X</span></li>
                    </ul>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id='btn_valider_attrib'>Submit</button>
            </div>
            <div class='text-center mb-3 div_message_modal'></div>
        </div>
    </div>
</div>


<!-- la modal pour modifier un todo-->

<div class="modal fade" id="exampleModalLabelModif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Modifier le TODO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <textarea class="form-control" id="exampleFormControlTextareaModifTache" rows="3" placeholder="..."></textarea>
                </div>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id='btn_valider_modif'>Submit</button>
            </div>
            <div class='text-center mb-3 div_message_modal'></div>
        </div>
    </div>
</div>

<div class="flex">

<div class="read">	
    <?php
        echo "<div style='text-align: center; height: 50px'> <h2>TODOList de ".$_SESSION['pseudo']."   <button type=\"button\" class=\"btn btn-primary test\" data-toggle=\"modal\" data-target=\"#exampleModal\" >ajouter un TODO </button></h2></div>";
    ?>
<div class="flex">
    <ul class='liste_tache' style="  list-style-type: none">
    	<!-- Zone d'affichage de la liste des tâches -->
    </ul>
</div>
<div>	
    <input type="hidden" name="" id='id_tache'>
    <input type="hidden" name="" id='tache'>
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