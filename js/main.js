
$(document).ready(function(){			
	let id_user = '2';//$('.contenu').val();
	if(!$('#btn_conn').length){	//	Efectuer les instructions qui suit si le bouton connexion n'éxiste pas (si on n'est pas dans page de connexion)
		//	Afficher la liste des tâches
		afficheListeTache(id_user);
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

$(document).on('click','.btn_ajout_t_u',function(){	
	let tache = 'azerty';//$('.contenu').val();
	let etat = 'qwerty';//$('.contenu').val();	
	let id_user = '1';//$('.contenu').val();		
	let id_prop = '2';//$('.contenu').val();
	$('.chk').each(function(){
		if($(this).is(':checked')){
			alert($('.chk').is(':checked')+$(this).val());
		}	
	});
	//	Ajouter une tâche
	ajouterTache(id_prop,tache,etat,id_user);	
});

$(document).on('click','.btn_valider_aj',function(){
	let tache = 'azerty';//$('.contenu').val();
	let etat = 'qwerty';//$('.contenu').val();	
	let id_user = '1';//$('.contenu').val();		
	let id_prop = '2';//$('.contenu').val();	
	//	Ajouter une tâche
	ajouterTache(id_prop,tache,etat,id_user);	
});

$(document).on('click','.btn_ajout_t',function(){
	//	Afficher la liste des utilisateurs	
		afficheListeUsers();		
});

$(document).on('click','.btn_modif',function(){	
	let tache = 'azerty';//$('.contenu').val();
	let etat = 'qwerty';//$('.contenu').val();	
	let id_user = '1';//$('.contenu').val();		
	let id_prop = '2';//$('.contenu').val();	
	mettreAjourTache(id_prop,tache,etat,id_user);
});

$(document).on('click','.btn_suppr',function(){	
	let id_tache = '2';//$('.contenu').val();
	//	Supprimer une tâche
	supprimerTache(id_tache)
});

function afficheListeTache(id_user){	
	let tache = 'azerty';//$('.contenu').val();
	let cpt =0;
	$.ajax({
		url : 'server.php',
		type : 'POST',
		data : {id_user:id_user,action:'voir'},
		success:function(reponse){
			let res_arr = JSON.parse(reponse);
			console.log(res_arr);
			if(res_arr[0].id != 'erreur'){
				res_arr.forEach(element =>{
					$('.liste_tache').append('<li><input type="checkbox" class="chk" name="chk'+cpt+'" value="'+element.id+'"><span> '+element.tache+'</span></br></li>');
				});
			}else{
				alert('Une erreur est survenu lors du chargement des données');
			}			
		}
	},'json');
}

function afficheListeUsers(){	
	$.ajax({
		url : 'server.php',
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

function ajouterTache(id_prop,tache,etat,id_user){		
	$.ajax({
		url : 'server.php',
		type : 'POST',
		data : {tache:tache,etat:etat,id_prop:id_prop,id_user:id_user,action:'ajout'},
		success:function(reponse){
			// alert(reponse);
			$('.contenu').html(reponse);
		}
	});
}

function mettreAjourTache(id_prop,tache,etat,id_user){	
	$.ajax({
		url : 'server.php',
		type : 'POST',
		data : {id_tache:id_tache,tache:tache,etat:etat,id_prop:id_prop,id_user:id_user,action:'modif'},
		success:function(reponse){
			alert(reponse);
			afficheListeTache(id_user);
		}
	});
}

function supprimerTache(id_tache){
	$.ajax({
		url : 'server.php',
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