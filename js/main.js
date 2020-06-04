 function htmlentities(str){
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
$(document).ready(function(){			
	let id_user = '2';//$('.contenu').val();
	if(!$('#btn_conn').length){	//	Efectuer les instructions qui suit si le bouton connexion n'éxiste pas (si on n'est pas dans page de connexion)
		//	Afficher la liste des tâches
		afficheListeTache();
	}
});

$(document).on('click','#btn_conn',function(e){
	e.preventDefault();
	//	Authetification de l'utilisateur
	authentification();
});

$(document).on('click','.btn_ajout_autre_u',function(){	
	let tache = 'azerty';//$('.contenu').val();
	let etat = 'qwerty';//$('.contenu').val();	
	let id_user = '1';//$('.contenu').val();		
	let id_prop = '2';//$('.contenu').val();	
	//	Ajouter une tâche
	ajouterTache(id_prop,tache,etat,id_user);	
});

// $(document).on('click','.btn_ajout_t_u',function(){	
// 	let tache = 'azerty';//$('.contenu').val();
// 	let etat = 'qwerty';//$('.contenu').val();	
// 	let id_user = '1';//$('.contenu').val();		
// 	let id_prop = '2';//$('.contenu').val();
// 	$('.chk').each(function(){
// 		if($(this).is(':checked')){
// 			alert($('.chk').is(':checked')+$(this).val());
// 		}	
// 	});
// 	//	Ajouter une tâche
// 	ajouterTache(id_prop,tache,etat,id_user);	
// });

$(document).on('click','#btn_valider_aj',function(e){	
	e.preventDefault();
	let tache = $('#exampleFormControlTextareaAjoutTache').val();
	//	Ajouter une tâche
	ajouterTache(tache);	
});

$(document).on('click','.btn_attrib',function(e){	
	$('#id_tache').val($(this).data("id_tache"));	
	$('#tache').val(htmlentities($(this).data("tache")));	
	let id_tache = $('#id_tache').val();
	let tache = $('#tache').val();
	$('#tacheToAttr').html("Tâche : "+tache);		
	//	Afficher la liste des utilisateurs	
	afficheListeUsers();
	//	Afficher la liste des utilisateurs affecté à la tâche séléctionné	
	afficheListeUsersAffecte(id_tache);		
});

$(document).on('click','#btn_valider_attrib',function(e){		
	e.preventDefault();
	let id_tache = $('#id_tache').val();
	let id_user_sel = $('#liste_u option:selected').val();
	//	Attribuer tâche
	atribuerTache(id_tache,id_user_sel);
});

$(document).on('click','.btn_modif',function(e){		
	e.preventDefault();
	$('#id_tache').val($(this).data("id_tache"));	
	$('#tache').val($(this).data("tache"));	
	$('#exampleFormControlTextareaModifTache').val($('#tache').val());
});

$(document).on('click','#btn_valider_modif',function(e){		
	e.preventDefault();
	let tache = $('#exampleFormControlTextareaModifTache').val();
	let id_tache = $('#id_tache').val();
	mettreAjourTache(id_tache,tache);
});

$(document).on('click','.btn_suppr',function(e){	
	e.preventDefault();
	let id_tache = $(this).data("id_tache");
	//	Supprimer une tâche
	supprimerTache(id_tache);
});

$(document).on('click','.btn_suppr_affect',function(e){	
	e.preventDefault();
	let id_affectation = $(this).data("id_affectation");
	//	Supprimer l'affectation d'un utilisateur
	supprimerAffectation(id_affectation);
});

$(document).on('click','.chk',function(){
	barrerTexte(this,$(this).data("cpt"));
	//	Mise à jour état
	mettreAjourEtat($(this).val(),this,$(this).data("etat"));
});

function afficheListeTache(){	
	$.ajax({
		url : 'scripts/server.php',
		type : 'POST',
		data : {action:'voir'},
		success:function(reponse){
			if(reponse!= 'erreur'){
				$('.liste_tache').html(reponse);
			}else{
				messageAlert('Message','Une erreur est survenu lors du chargement des données');
			}			
		}
	});
}

function afficheListeUsers(){	
	$.ajax({
		url : 'scripts/server.php',
		type : 'POST',
		data : {action:'liste_user'},
		success:function(reponse){
			let res_arr = JSON.parse(reponse);
			let contenuHtml = '';
			if(res_arr[0].id != 'erreur'){
				contenuHtml += '<option selected>Attribuer à un utilisateur</option>';
				res_arr.forEach(element =>{
					contenuHtml += '<option value="'+element.id+'">'+element.nom+'</option>';
				});

				$('#liste_u').html(contenuHtml);
			}else{
				messageModal('Message','Une erreur est survenu lors du chargement de la liste des utilisateurs');
			}			
		}
	},'json');
}

function afficheListeUsersAffecte(id_tache){
	$.ajax({
		url : 'scripts/server.php',
		type : 'POST',
		data : {idtache:id_tache,action:'liste_user_aff'},
		success:function(reponse){
			let res_arr = JSON.parse(reponse);
			let contenuHtml = '';
			if(res_arr[0].id != 'erreur'){
				res_arr.forEach(element =>{
					contenuHtml += '<li >'+element.nom+'<span class="ml-2 mr-2 badge badge-secondary text-wrap btn_suppr_affect" data-id_affectation = "'+element.id_affectation+'">X</span></li>';
				});

				$('.liste_u_aff').html(contenuHtml);
			}else{
				messageModal('Message','Une erreur est survenu lors du chargement de la liste des utilisateurs');
			}			
		}
	},'json');
}

function supprimerAffectation(id_affectation){
	 $.confirm({
	    title: 'Confirmation',
	    content: 'Vous êtes êtes sur le point de supprimer l\'affectation de cette utilisateur à cette tâche, voulez-vous continuer?',
	    buttons: {
	        OUI: function () {	           
				$.ajax({
					url : 'scripts/server.php',
					type : 'POST',
					data : {id:id_affectation,action:'suppr_affect'},
					success:function(reponse){
						if(reponse=='ok'){
							location.replace('dashboard.php');
						}else{
							messageModal(reponse,'red');
						}
					}
				});	
	        },
	        NON: function () {
	           // Ne rien effectuer
	         }
	    }
	  });
}

function ajouterTache(tache){		
	$.ajax({
		url : 'scripts/server.php',
		type : 'POST',
		data : {tache:tache,action:'ajout'},
		success:function(reponse){
			if(reponse=='ok'){
				location.replace('dashboard.php');
			}else{
				messageModal(reponse,'red');
			}
		}
	});
}

function mettreAjourTache(id_tache,tache){

	$.ajax({
		url : 'scripts/server.php',
		type : 'POST',
		data : {id:id_tache,tache:tache,action:'modif'},
		success:function(reponse){
			if(reponse=='ok'){
				messageAlert('Message','Mise à jour de la tâche effectué avec succès');
				setTimeout(function(){
					location.replace('dashboard.php');
				},1500);
			}else{
				messageModal(reponse,'red');
			}
		}
	});
}

function atribuerTache(id_tache,id_user){
	$.ajax({
		url : 'scripts/server.php',
		type : 'POST',
		data : {idtache:id_tache,iduser:id_user,action:'attrib'},
		success:function(reponse){console.log(reponse);
			if(reponse=='ok'){
				messageAlert('Message','Attribution de tâche effectué avec succès');
				setTimeout(function(){
					location.replace('dashboard.php');
				},1500);
			}else{
				messageModal(reponse,'red');
			}
		}
	});
}

function mettreAjourEtat(id_tache,elem,etat){
	$.ajax({
		url : 'scripts/server.php',
		type : 'POST',
		data : {id:id_tache,etat:etat,action:'modif_etat'},
		success:function(reponse){
			// console.log(reponse);
		}
	});
}

function supprimerTache(id_tache){
	 $.confirm({
	    title: 'Confirmation',
	    content: 'Vous êtes êtes sur le point de supprimer cette tâche, voulez-vous continuer?',
	    buttons: {
	        OUI: function () {	           
				$.ajax({
					url : 'scripts/server.php',
					type : 'POST',
					data : {id:id_tache,action:'suppr'},
					success:function(reponse){
						location.reload();
					}
				});	
	        },
	        NON: function () {
	           // Ne rien effectuer
	         }
	    }
	  });
}

function authentification(){
	let username = $('#username').val();
	let password = $('#password').val();
	if(username == ''){
		messageAlert('Message','Veuillez renseigner votre Username');
	}else if(password == ''){
		messageAlert('Message','Veuillez renseigner votre Mot de passe');
	}else{			
		$.ajax({
			url : 'scripts/server.php',
			type : 'POST',
			data : {username:username,password:password},
			success:function(reponse){
				console.log(reponse);
				if(reponse=='ok'){
					location.replace('dashboard.php');
				}else{
					message(reponse,'red');
				}
			}
		});	
	}
}

function barrerTexte(elem,cpt) {
    // Si la case est coché on barre le text
    if (elem.checked == true){
        $("#text_tache"+cpt).addClass('barrer');
    } else {
        $("#text_tache"+cpt).removeClass('barrer');
    }
}


function message(msg,couleur){
  if($('#div_message').length){ 
    $('#div_message').css({"color":couleur}); 
    $('#div_message').fadeIn();      
    $('#div_message').html(msg);                    
    setTimeout(function(){$('#div_message').fadeOut();},4000);
  } 
}

//  Définition de fonction d'affichage de message
function messageModal(msg,couleur){
  if($('.div_message_modal').length){ 
    $('.div_message_modal').css({"color":couleur}); 
    $('.div_message_modal').fadeIn();      
    $('.div_message_modal').html(msg);                    
    setTimeout(function(){$('.div_message_modal').fadeOut();},4000);
  } 
}

//  Définition de fonction d'affichage de message
function messageAlert(titre,msg){
  $.alert({
    title: titre,
    content: msg,
  });
}
