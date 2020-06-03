
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

$(document).on('click','.btn_ajout_t',function(e){
	//	Afficher la liste des utilisateurs	
		afficheListeUsers();		
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

$(document).on('click','.chk',function(){
	barrerTexte(this,$(this).data("cpt"));
	//	Mise à jour état
	mettreAjourEtat($(this).val(),this,$(this).data("etat"));
});

function afficheListeTache(){	
	let tache = 'azerty';//$('.contenu').val();
	let cpt =0;
	$.ajax({
		url : 'scripts/server.php',
		type : 'POST',
		data : {action:'voir'},
		success:function(reponse){
			let res_arr = JSON.parse(reponse);
			console.log(res_arr);
			let contenuHtml = "";
			if(res_arr[0].id != 'erreur'){
				res_arr.forEach(element =>{
					contenuHtml += '<li class="row">';
					if(element.etat == 0){
	  					contenuHtml += '<div class=" col"><input class="form-check-input chk" type="checkbox" name="chk'+cpt+'" id="chk'+cpt+'" value="'+element.id+'"  data-cpt="'+cpt+'" data-etat="'+element.etat+'"></div>';						
					}else{
						contenuHtml += '<div class=" col"><input class="form-check-input chk" type="checkbox" name="chk'+cpt+'" id="chk'+cpt+'" value="'+element.id+'"  data-cpt="'+cpt+'" data-etat="'+element.etat+'" checked></div>';						
					}
	    			contenuHtml += '<div class="col">';

	    			if(element.etat == 0){
	        			contenuHtml += '<p><span id="text_tache'+cpt+'" class=""> '+element.tache+'</span></p>';
	        		}else{
	        			contenuHtml += '<p><span id="text_tache'+cpt+'" class="barrer"> '+element.tache+'</span></p>';
					}
	        		contenuHtml += '</div>'+
	    							'<div class=" col"> <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1" data-id_tache="'+element.id+'">attribuer</button></div>'+
	    							'<div class=" col">  <button class="btn btn-primary btn_modif" data-toggle="modal" data-target="#exampleModalLabelModif" data-id_tache="'+element.id+'" data-tache="'+element.tache+'">modifier</button></div>'+
	    							'<div class=" col">  <button class="btn btn-primary btn_suppr" data-toggle="modal" data-target="#exampleModalLabelsuppr" data-id_tache="'+element.id+'">supprimer</button></div>'+
								'</li>';
					cpt++;
				});
				$('.liste_tache').html(contenuHtml);
			}else{
				alert('Une erreur est survenu lors du chargement des données');
			}			
		}
	},'json');
}

function afficheListeUsers(){	
	$.ajax({
		url : 'scripts/server.php',
		type : 'POST',
		data : {action:'liste_user'},
		success:function(reponse){
			let res_arr = JSON.parse(reponse);
			if(res_arr[0].id != 'erreur'){
				res_arr.forEach(element =>{
					$('#liste_u').append('<option value="'+element.id+'">'+element.nom+'</option>');
				});
			}else{
				alert('Une erreur est survenu lors du chargement des données');
			}			
		}
	},'json');
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
				message(reponse,'red');
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
				location.replace('dashboard.php');
			}else{
				message(reponse,'red');
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
	$.ajax({
		url : 'scripts/server.php',
		type : 'POST',
		data : {id:id_tache,action:'suppr'},
		success:function(reponse){
			location.reload();
		}
	});	
}

function authentification(){
	let username = $('#username').val();
	let password = $('#password').val();
	if(username == ''){
		alert('Veuillez renseigner votre Username');
	}else if(password == ''){
		alert('Veuillez renseigner votre Mot de passe');
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

function message(msg,couleur){
  if($('#div_message').length){ 
    $('#div_message').css({"color":couleur}); 
    $('#div_message').fadeIn();      
    $('#div_message').html(msg);                    
    setTimeout(function(){$('#div_message').fadeOut();},4000);
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
