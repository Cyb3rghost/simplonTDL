<?php
	if(isset($_POST['username'])&&isset($_POST['password'])){
		//	Connexion de l'utiisateur
		require('connexion.php');
	}elseif(isset($_POST['action']) || isset($_POST['action'])){
		$id_prop = isset($_POST['id_prop'])?$_POST['id_prop']:$id_prop;
		$action = isset($_POST['action'])?$_POST['action']:$action;		
		if($action == 'liste_user'){
			//	Récupération de la liste des utilisateurs
			require('listetaches.php');
			//echo json_encode($liste_user);
		}elseif($action == 'voir'){			
			if(isset($_POST['id_user'])){
				//	Récupération de la liste des tâches

				//echo json_encode($data);
			}else{
				echo json_encode(array(array('id' => 'erreur')));
			}
		}elseif($action == 'ajout'){
			//	Code pour l'ajout
			require('ajout.php');
		}elseif($action == 'modif'){
				//	Code pour la mise à jour des tâches

			}elseif($action == 'suppr'){
				//	Code pour la suppression

		}
	}
