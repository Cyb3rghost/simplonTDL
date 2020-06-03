
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

$(document).on('click','.btn_valider_aj',function(){
	let tache = $('.tache').val();
	//	Ajouter une tâche
	ajouterTache(tache);	
});

$(document).on('click','.btn_ajout_t',function(){
	//	Afficher la liste des utilisateurs	
		afficheListeUsers();		
});

$(document).on('click','.btn_modif',function(){		
	let id_tache = $(this).data("cpt");
	mettreAjourTache(id_tache);
});

$(document).on('click','.btn_suppr',function(){	
	let id_tache = $(this).data("cpt");
	//	Supprimer une tâche
	supprimerTache(id_tache)
});

<<<<<<< HEAD
$(document).on('click','.chk',function(){	
	myFunction(this,$(this).data("cpt"));
});

function afficheListeTache(id_user){	
=======
$(document).on('click','.chk',function(){
	barrerTexte(this,$(this).data("cpt"));
	if (elem.checked == true){
        $("#text_tache"+cpt).addClass('barrer');
    } else {
        $("#text_tache"+cpt).removeClass('barrer');
    }
});

function afficheListeTache(){	
>>>>>>> 4c3833d57b48986cff9dcad8319fbbf611bd9cbc
	let tache = 'azerty';//$('.contenu').val();
	let cpt =0;
	$.ajax({
		url : 'scripts/server.php',
		type : 'POST',
		data : {action:'voir'},
		success:function(reponse){
			let res_arr = JSON.parse(reponse);
			console.log(res_arr);
			if(res_arr[0].id != 'erreur'){
				res_arr.forEach(element =>{
					let contenuHtml = '<li class="row">';
					if(element.etat == 0){
<<<<<<< HEAD
	  					contenuHtml += '<div class=" col"><input class="form-check-input chk" type="checkbox" name="chk'+cpt+'" value="'+element.id+'"></div>';						
					}else{
						contenuHtml += '<div class=" col"><input class="form-check-input chk" type="checkbox" name="chk'+cpt+'" value="'+element.id+'" checked></div>';						
					}
	    			contenuHtml += '<div class="col">'+
	        						'<p><span id="text_tache'+cpt+' data-cpt="'+cpt+'"> '+element.tache+'</span></p></div>'+
	    							'<div class=" col"> <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">attribuer</button></div>'+
	    							'<div class=" col">   <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">modifier</button></div>'+
								'</li>';
					$('.liste_tache').append(contenuHtml);
=======
	  					contenuHtml += '<div class=" col"><input class="form-check-input chk" type="checkbox" name="chk'+cpt+'" id="chk'+cpt+'" value="'+element.id+'"  data-cpt="'+cpt+'"></div>';						
					}else{
						contenuHtml += '<div class=" col"><input class="form-check-input chk" type="checkbox" name="chk'+cpt+'" id="chk'+cpt+'" value="'+element.id+'"  data-cpt="'+cpt+'" checked></div>';						
					}
	    			contenuHtml += '<div class="col">'+
	        						'<p><span id="text_tache'+cpt+'"> '+element.tache+'</span></p></div>'+
	    							'<div class=" col"> <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1" data-id_tache="'+element.id+'">attribuer</button></div>'+
	    							'<div class=" col">   <button class="btn btn-primary btn_modif" data-toggle="modal" data-target="#exampleModalLabelModif" data-id_tache="'+element.id+'">modifier</button></div>'+
								'</li>';
					$('.liste_tache').append(contenuHtml);
					//	Barrer Texte
					barrerTexte($('chk'+cpt),cpt);
					cpt++;
>>>>>>> 4c3833d57b48986cff9dcad8319fbbf611bd9cbc
				});
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

function mettreAjourTache(id_tache){	
	$.ajax({
		url : 'scripts/server.php',
		type : 'POST',
		data : {id:id_tache,action:'modif'},
		success:function(reponse){
			// alert(reponse);
			afficheListeTache();
		}
	});
}

function supprimerTache(id_tache){
	$.ajax({
		url : 'scripts/server.php',
		type : 'POST',
		data : {id_tache:id_tache,action:'suppr'},
		success:function(reponse){
			alert(reponse);
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

<<<<<<< HEAD
function myFunction(elem,cpt) {
    // Get the output text
    var text = document.getElementById("text");
    // If the checkbox is checked, display the output text
    if (elem.checked == true){
        document.getElementById("text_tache"+cpt).classList.add('barrer');
    } else {
        document.getElementById("text_tache"+cpt).classList.add('nonbarrer');
=======
function barrerTexte(elem,cpt) {
    // Si la case est coché on barre le text
    if (elem.checked == true){
        $("#text_tache"+cpt).addClass('barrer');
    } else {
        $("#text_tache"+cpt).removeClass('barrer');
>>>>>>> 4c3833d57b48986cff9dcad8319fbbf611bd9cbc
    }
}