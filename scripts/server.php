<?php
	if(isset($_POST['username'])&&isset($_POST['password'])){
		//	Connexion de l'utiisateur
		require('connexion.php');
	}elseif(isset($_POST['action']) || isset($_POST['action'])){
		$id_prop = isset($_POST['id_prop'])?$_POST['id_prop']:'';
		$action = isset($_POST['action'])?$_POST['action']:$action;		
		if($action == 'liste_user'){
			//	Récupération de la liste des utilisateurs
			//echo json_encode($liste_user);
		}elseif($action == 'voir'){		
				//	Récupération de la liste des tâches
				require('listetaches.php');	
			if($erreur == 0){
				// echo json_encode($arr_res);	//	Variable définie dans le fichier "listetaches.php";

				$contenuHtml = "";
				$cpt =0;

				foreach ($arr_res as $element) {
					$contenuHtml .= '<li class="row">';
					if($element['etat'] == 0){
	  					$contenuHtml .= '<div class=" col"><input class="form-check-input chk" type="checkbox" name="chk'.$cpt.'" id="chk'.$cpt.'" value="'.$element['id'].'"  data-cpt="'.$cpt.'" data-etat="'.$element['etat'].'"></div>';						
					}else{
						$contenuHtml .= '<div class=" col"><input class="form-check-input chk" type="checkbox" name="chk'.$cpt.'" id="chk'.$cpt.'" value="'.$element['id'].'"  data-cpt="'.$cpt.'" data-etat="'.$element['etat'].'" checked></div>';						
					}
	    			$contenuHtml .= '<div class="col">';

	    			if($element['etat'] == 0){
	        			$contenuHtml .= '<p><span id="text_tache'.$cpt.'" class=""> '.$element['tache'].'</span></p>';
	        		}else{
	        			$contenuHtml .= '<p><span id="text_tache'.$cpt.'" class="barrer"> '.$element['tache'].'</span></p>';
					}

					if($element['id_prop']==='1'){
			    		$contenuHtml .= '</div>'.
							'<div class=" col"> <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1" data-id_tache="'.$element['id'].'">attribuer</button></div>'.
							'<div class=" col">  <button class="btn btn-primary btn_modif" data-toggle="modal" data-target="#exampleModalLabelModif" data-id_tache="'.$element['id'].'" data-tache="'.$element['tache'].'">modifier</button></div>'.
							'<div class=" col">  <button class="btn btn-primary btn_suppr" data-toggle="modal" data-target="#exampleModalLabelsuppr" data-id_tache="'.$element['id'].'">supprimer</button></div>';
					}else{
						$contenuHtml .= '</div>'.
											'<div class=" col" style="color:red"> Accès restreint</div>'.
										'</div>';
					}
						$contenuHtml .= '</li>';
					$cpt++;
				}
				echo $contenuHtml;
			}else{
				// echo json_encode(array(array('id' => 'erreur')));
				echo 'erreur';
			}
		}elseif($action == 'ajout'){
			//	Code pour l'ajout
			require('ajout.php');
		}elseif($action == 'modif'){
			//	Code pour la mise à jour des tâches			
			require('modification.php');
		}elseif($action == 'modif_etat'){
			//	Code pour la modification de l'état
			require('valide.php');
		}elseif($action == 'suppr'){
			//	Code pour la suppression
			require('suppression.php');
		}
	}
