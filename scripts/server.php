<?php
	if(isset($_POST['username'])&&isset($_POST['password'])){
		//	Connexion de l'utiisateur
		require('connexion.php');
	}elseif(isset($_POST['action']) || isset($_POST['action'])){
		//	Définition de la variable action
		$action = isset($_POST['action'])?$_POST['action']:'';		
		if($action == 'liste_user'){
			//	Récupération de la liste des utilisateurs
			require('listeusers.php');	
			echo json_encode($arr_res);
		}elseif($action == 'voir'){		
				//	Récupération de la liste des tâches
				require('listetaches.php');	
			if($erreur == 0){
				$contenuHtml = "";
				$cpt =0;
				//	Affichage de la liste des utilisateurs
				foreach ($arr_res as $element) {
               		$contenuHtml .= '<div class="cadrePerso bg-white text-black"><div class="row"><div class="col-6">';
                    $contenuHtml .= '<div class="form-check text-center">';
						if($element['etat'] == 0){	//	Si la tache n'est pas effectué (etat=0) on ne la coche pas sinon on la coche
		  					$contenuHtml .= '<input class="form-check-input chk" type="checkbox" name="chk'.$cpt.'" id="chk'.$cpt.'" value="'.$element['id'].'"  data-cpt="'.$cpt.'" data-etat="'.$element['etat'].'">';						
						}else{
							$contenuHtml .= '<input class="form-check-input chk" type="checkbox" name="chk'.$cpt.'" id="chk'.$cpt.'" value="'.$element['id'].'"  data-cpt="'.$cpt.'" data-etat="'.$element['etat'].'" checked>';						
						}

						if($element['etat'] == 0){	//	Si la tache n'est pas effectué (etat=0) on ne la barre pas sinon on la barre automatiquement
		        			$contenuHtml .= '<label id="text_tache'.$cpt.'" class="form-check-label" for="chk'.$cpt.'"> '.$element['tache'].'</label>';
		        		}else{
		        			$contenuHtml .= '<label id="text_tache'.$cpt.'" class="form-check-label barrer" for="chk'.$cpt.'"> '.$element['tache'].'</label>';
						}                       
                    	$contenuHtml .= '</div>';
	                $contenuHtml .= '</div>';
		            $contenuHtml .= '<div class="col-6 text-center">';
	                if($element['id_prop']==='1'){	//	Si l'utilisateur connécté est le propriétaire on affiche les bouton de controle sinon on affiche un message
	                	if($element['etat'] == 0){
		                    $contenuHtml .= '<img width="35" height="35" src="image/attribution.png" class="btn_attrib"  title="Attribuer une tâche" alt="" data-toggle="modal" data-target="#exampleModal1" data-id_tache="'.$element['id'].'" data-tache="'.$element['tache'].'">'; 
	                    	$contenuHtml .= '<img width="35" height="35" src="image/update.png" class="btn_modif" title="Mise à jour d\'une tâche" alt="" data-toggle="modal" data-target="#exampleModalLabelModif" data-id_tache="'.$element['id'].'" data-tache="'.$element['tache'].'"> ';
		                }else{
		                    $contenuHtml .= '<img width="35" height="35" src="image/vide.png">'; 
	                    	$contenuHtml .= '<img width="35" height="35" src="image/vide.png""> ';
		                }
	                    $contenuHtml .= '<img width="35" height="35" src="image/supprimer.png" class="btn_suppr" title="Supprimer" alt="" data-toggle="modal" data-target="#exampleModalLabelsuppr" data-id_tache="'.$element['id'].'">';
		            }else{
						$contenuHtml .=	'<div style="color:red">Accès restreint</div>';
					}
					$contenuHtml .= '</div>';
					$contenuHtml .= '</div>';
					$contenuHtml .= '</div>';
					$cpt++;
				}
				echo $contenuHtml;
			}else{
				echo 'erreur';	//	Utilisé dans main.js
			}
		}elseif($action == 'ajout'){
			//	Ajout de tâche
			require('ajout.php');
		}elseif($action == 'modif'){
			//	Mise à jour des tâches			
			require('modification.php');
		}elseif($action == 'modif_etat'){
			//	Modification de l'état
			require('valide.php');
		}elseif($action == 'suppr'){
			//	Suppression tâche
			require('suppression.php');
		}elseif($action == 'attrib'){
			//	Aattribution
			require('attribution.php');
		}elseif($action == 'liste_user_aff'){
			//	Affichage de la liste des utilisateur affecté à une tâche
			require('listeutilisateursattribuer.php');
			echo json_encode($arr_res);
		}elseif($action == 'suppr_affect'){
			//	Suppression de affectation d'un utilisateur
			require('suppression_attribution.php');
		}
	}
