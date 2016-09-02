$(document).ready(function(){


	// Modification des caractéristiques du client et mise à jour en Ajax

	$(".editableTd").click(function()  
		//Fonction activée quand on clique sur une cellule <td>
		{ 
			if($(this).attr("contenteditable") == "true") 
			//Si l'attribut "contenteditable" est égal à "true"
		{    

    var id_bdd = $(this).attr("id"); // indique l'id dans la BDD => id  
    var champ_bdd = $(this).attr("name"); // indique le nom de la colonne dans la table "client" => col
    var contenu_avant = $(this).text(); // contenu de la <td> avant modification 
    var val_avt = $(this).val();

    $(this).blur(function() 
    	// Fonction activée lorsque la <td> perd le focus
    	{ 
    	var contenu_apres = $(this).text(); // on associe à cette variable ce qu'on vient d'entrer
      var val_apres = $(this).val();

      if (contenu_avant != contenu_apres) 
         	// Si le contenu est différent alors la modification en Ajax est lancée
         { 

         	$.ajax({ 
         		url: "ClientsController/modifierClient", // chemin qui pointe vers le fichier .php et la fonction modifierClient  
         		type: "POST", // méthode POST pour envoyer les changements  
         		data: { col: champ_bdd, id: id_bdd, val: contenu_apres }, // on associe aux paramètres de la fonction modifierClient les nouvelles valeures
         		success: function(data) 
            {  // Fenêtre d'alert pour indiquer le changement
            alert('Modification de "'+champ_bdd+'" : '+contenu_apres); 
          } 
        }).once(); 
         }else if(val_avt != val_apres)
         {

          $.ajax({ 
            url: "ClientsController/modifierClient", // chemin qui pointe vers le fichier .php et la fonction modifierClient  
            type: "POST", // méthode POST pour envoyer les changements  
            data: { col: champ_bdd, id: id_bdd, val: val_apres }, // on associe aux paramètres de la fonction modifierClient les nouvelles valeures
            success: function(data) 
            {  // Fenêtre d'alert pour indiquer le changement
            alert('Modification de "'+champ_bdd+'" : '+val_apres); 
          } 
        }).once();
        } 

      }); 

  };     

}); // Fin de la fonction modifier client


  // Suppression d'un client ainsi que retirer la ligne du tableau en Ajax

  $('.supprTd').click(function() 
    // Fonction activée lorque l'utilisateur clique sur la balise "<td>" supprimer 
    {
		var selectedTr = $(this).closest('tr'); // indique la ligne "<tr>" séléctionnée
		var id_bdd = $(this).closest('tr').attr('id'); // indique l'id dans la BDD => id 
    var entreprise = selectedTr.attr('name'); // indique le nom de l'entreprise séléctionnée

        var msg = confirm("Voulez-vous supprimer "+entreprise+" ?"); // Message pour confirmer ou non la suppression

        if(msg == true) // Si l'utilisateur confirme alors la suppression en Ajax est lancée
        {
          $.ajax({ 
                 url: "ClientsController/supprimerClient", // chemin qui pointe vers le fichier .php et la fonction supprimerClient  
                 type: "POST", // méthode POST pour envoyer l'id du client  
                 data: { id: id_bdd }, // on asscoie au paramètre de la fonction supprimer l'id du client
                 success: function(html) 
                 { // Effet 'fadeOut' pour faire disparaître la ligne du tableau
                 selectedTr.fadeOut('slow', function()
                  { // Méthode 'remove' pour retirer la ligne du tableau
                  selectedTr.remove();
                });
               } 
             });
        }
      }); // Fin de la fonction supprimer client


  // Fonction pour repositionner les liens "<a>" à droite dans la "#myNavBar" sur la version mobile

  $('#btnMenu').click(function()
  {
    $('#myNavBar a').css({"text-align": "right"});
  });

  $('#myMobileTable tr').click(function(){
    var id_bdd = $(this).attr("id");
    window.location.assign('modifClient?id='+id_bdd);
  });


  //Fonction pour ajouter un produit

  $("#ajoutProd").click(function()
  { // Fonction activée lorsque l'on clique sur le bouton "Ajouter" de la page produits

    var prod = $('#nouveauProd').val(); // Affectation à "prod" du nom du produit
    var lastDiv = $('.editableDiv:last'); // Indique la dernière div de la classe ".editableDiv" 

    $.ajax({ 
            url: "ProduitsController/nouveauProduit", // chemin qui pointe vers le fichier .php et la fonction nouveauProduit  
            type: "POST", // méthode POST pour envoyer le nom du produit  
            data: { produit: prod }, // on associe aux paramètres de la fonction modifierProduit les nouvelles valeures
            success: function(data) 
            {  // Ajoue de la ligne contenant le produit créé
              $('<div id="<?php echo $object->id_produit ;?>" name="produit" contenteditable="true" class="editableDiv">'+prod+'<span class="trashProd glyphicon glyphicon-trash"></span></div>').hide().appendTo(lastDiv).slideDown();
            } 
          });
  }); // Fin de la fonction ajouter produit


  // Fonction pour modifier un produit

  $(".editableDiv").click(function()  
    // Fonction activée quand on clique sur une cellule <td>
    { 
      if($(this).attr("contenteditable") == "true") 
      // Si l'attribut "contenteditable" est égal à "true"
    {    

    var id_prod = $(this).attr("id"); // indique l'id dans la BDD => id  
    var contenu_avt = $(this).text(); // contenu de la <td> avant modification 

    $(this).blur(function() 
      // Fonction activée lorsque la <td> perd le focus
      { 
      var contenu_apr = $(this).text(); // on associe à cette variable ce qu'on vient d'entrer

      if (contenu_avt != contenu_apr) 
          // Si le contenu est différent alors la modification en Ajax est lancée
        { 

          $.ajax({ 
            url: "ProduitsController/modifierProduit", // chemin qui pointe vers le fichier .php et la fonction modifierProduit  
            type: "POST", // méthode POST pour envoyer le changement
            data: { id: id_prod, val: contenu_apr }, // on associe aux paramètres de la fonction modifierProduit les nouvelles valeures
            success: function(data) 
            {  // Message d'alert pour indiquer le changement
            alert('Modification de "'+champ_bdd+'" : '+contenu_apr);
          } 
        }); 
        } 

      }); 

  };     

  }); // Fin de la fonction modifier produit


    //Fonction pour supprimer un produit

    $('.trashProd').click(function()
      // Fonction activée quand on clique sur l'icône poubelle
      {
      var selectedDiv = $(this).closest('div'); // Indique la div dans laquelle on clique
      var id_prod_suppr = $(this).closest('div').attr('id'); // Association de l'id du produit à supprimer
      var produit = $(this).attr('name'); // Association du nom du produit à supprimer

        var msg = confirm("Voulez-vous supprimer "+produit+" ?"); // Message pour confirmer ou non la suppression

        if(msg == true) // Si l'utilisateur confirme alors la suppresion en Ajax est lancée
        {
          $.ajax({ 
                 url: "ProduitsController/supprimerProduit", // chemin qui pointe vers le fichier .php et la fonction supprimerProduit  
                 type: "POST", // méthode POST pour envoyer l'id du produit  
                 data: { id: id_prod_suppr }, 

                 success: function(html) 
                 { // Effet 'slideUp' pour faire disparaître la div
                 selectedDiv.slideUp('slow', function()
                  { // Méthode 'remove' pour retirer la div de la page
                  selectedDiv.remove();
                });
               } 
             });
        }

      }); // Fin de la fonction supprimer produit


    // Fonction pour ajouter un utilisateur

    $('#ajoutUser').click(function()
      { // Fonction activée quand on clique sur le bouton 'Ajouter utilisateur' de la page utilisateurs
      $('#formUser').slideDown(); // Effet 'slideDown' pour faire apparaître les champs d'ajout
    });

    $('#btnNewUser').click(function()
      // Fonction activée quand on clique sur le bouton 'Valider'
      { 
       // Affectation aux variables des données entrées
       var prenom = $('#inputPrenom').val();
       var nom = $('#inputNom').val();
       var login = $('#inputLogin').val();
       var mdp = $('#inputMdp').val();
       var role = $('#inputRole').val();
      var lastTr = $('.editableTr:last'); // Indique la dernière ligne du tableau

      $.ajax({ 
            url: "UserController/nouvelUtilisateur", // chemin qui pointe vers le fichier .php et la fonction nouvelUtilisateur  
            type: "POST", // méthode POST pour envoyer les données  
            data: { prenom: prenom, nom: nom, login: login, mdp: mdp, role: role }, // on associe aux paramètres de la fonction nouvelUtilisateur les nouvelles valeures
            success: function(data) 
            {  // Effet 'slideUp' pour faire disparaître les champs d'ajout
            $('#formUser').slideUp();
              // Méthode 'after' pour ajouter l'utilisateur créé
              lastTr.after('<tr class="editableTr"><td id="<?php echo $object->id_user ;?>" name="utilisateur" contenteditable="true" class="editableTd">'+prenom+'</td><td name="utilisateur" contenteditable="true" class="editableTd">'+nom+'</td><td name="utilisateur" contenteditable="true" class="editableTd">'+login+'</td><td id="<?php echo $object->id_user ;?>" name="role" contenteditable="false" class="editableTdUser"><select class="form-control" name="role" id="selectRole"><?php if($object->admin == 1){?><option value="1">Administrateur</option><option value="0">Utilisateur</option><?php}else{?><option value="0">Utilisateur</option><option value="1">Administrateur</option><?php}?></select></td><td><span class="trashProd glyphicon glyphicon-trash"></span></td></tr>');
              // Message d'alert pour indiquer les données de l'utilisateur créé dont "identifiant" et "mdp" à communiquer à l'utilisateur
              alert("Nouvel utilisateur créé");
            } 
          });


    }); // Fin de la fonction ajouter utilisateur


    //Fonction pour supprimer un utilisateur

    $('.trashUtil').click(function()
      // Fonction activée quand on clique sur l'icône poubelle
      {
      var selectedTr = $(this).closest('tr'); // indique la ligne "<tr>" séléctionnée
      var id_util_suppr = $(this).closest('tr').attr('id'); // indique l'id de l'utilisateur à supprimer
      var utilisateur = $(this).attr('name'); // indique le nom de l'utilisateur à supprimer

        var msg = confirm("Voulez-vous supprimer : "+utilisateur+" ?"); // Message pour confirmer ou non la suppression

        if(msg == true) // Si l'utilisateur confirme
        {
          $.ajax({ 
                 url: "UserController/supprimerUtilisateur", // chemin qui pointe vers le fichier .php et la fonction supprimerUtilisateur  
                 type: "POST", // méthode POST envoyer l'id du client  
                 data: { id: id_util_suppr }, 

                 success: function(html) 
                 { // Effet 'fadeOut' pour faire disparaître la ligne du tableau
                 selectedTr.fadeOut('slow', function()
                  { // Méthode 'remove' pour retirer la ligne du tableau
                  selectedTr.remove();
                });
               } 
             });
        }

      }); // Fin de la fonction supprimer utilisateur


    //Fonction pour modifier un utilisateur

    $(".editableTdUser").click(function()  
    //Fonction activée quand on clique sur une cellule <td>
    { 
      if($(this).attr("contenteditable") == "true" || $(this).attr("name") == "role") 
      //Si l'attribut "contenteditable" est égal à "true"
    {    

    var id_utilisateur = $(this).attr("id"); // indique l'id dans la BDD => id  
    var champ_bdd = $(this).attr("name"); // indique le nom de la colonne dans la table "utilisateur" => col
    var contenu_avt = $(this).text(); // contenu de la <td> avant modification =>val
    var role_avt = $(this).find('#selectRole').val(); // indique le rôle de l'utilisateur avec modification

    $(this).focusout(function() 
      //Fonction activée lorsque la <td> perd le focus
      { 
      var contenu_apr = $(this).text(); // on associe à cette variable ce qu'on vient d'entrer
      var role_apr = $(this).find('#selectRole').val(); // indique la valeur rôle de l'utilisateur (1 ou 0)
      var role_txt = $(this).find('#selectRole option:selected').text(); // indique si 'utilisateur' ou 'administrateur'

      if (contenu_avt != contenu_apr || role_avt != role_apr) 
          // Si le contenu est différent alors on lance la modification en Ajax
        { 

          $.ajax({ 
            url: "UserController/modifierUtilisateur", // chemin qui pointe vers le fichier .php et la fonction modifierUtilisateur  
            type: "POST", // méthode POST envoyer les changements  
            data: { col: champ_bdd, id: id_utilisateur, val: contenu_apr, role: role_apr }, // on associe aux paramètres de la fonction modifierUtilisateur les nouvelles valeures
            success: function(data) 
            {  // Si champs modifiés afficher message d'alerte
            if(contenu_avt != contenu_apr)
            { 
              alert('Modification de "'+champ_bdd+'" : '+contenu_apr);
            }
            else if(role_avt != role_apr)
              { // Si rôle modifié afficher message d'alerte
            alert('Modification du "'+champ_bdd+'" : '+role_txt);
          } 
        }
      }).once(); 
        } 

      }); 

  };     

    }); // Fin de la fonction modifier un utilisateur


    // Fonction pour afficher commentaires

    $('.tdComment, #commDown').hover(function()
    {
      $(this).css('cursor','pointer');

      $(this).click(function()
      {
        var selectedDiv = $('.commDiv');

        selectedDiv.slideToggle().once();
      });

    }); // Fin de la fonction afficher commentaires


    //Fonction pour cacher les commentaires

    $('#commUp').click(function()
    {
      var selectedDiv = $('.commDiv');
      selectedDiv.slideUp();

      }); // Fin de la fonction cacher commentaires


    // Fonction pour ajouter un commentaire

    $('#newComm').click(function()
    {
      $('.newCommTr').slideDown().once();

    }); 

    $('#submitComm').click(function()
    {
      var comment = $('.newComment').val();
      var client = $(this).closest('td').attr('id'); 
      var login = $(this).closest('td').attr('class');
      var firstTr = $('.myComments:first');

      $.ajax({

            url: "CommController/ajouterCommentaire", // chemin qui pointe vers le fichier .php et la fonction supprimerUtilisateur  
            type: "POST", // méthode POST envoyer l'id du client  
            data: { commentaire: comment, client: client, utilisateur: login }, 
            success: function(html) 
            { 
              firstTr.before('<tr><td>'+comment+'</td></tr>');
            } 
          });

    }); // Fin de la fonction ajouter commentaire


    // Fonction pour supprimer un commentaire

    $('.supprComm').click(function()
    {

      var id_comm = $(this).attr('id');
      var selectedTr = $(this).closest('tr');

      $.ajax({

            url: "CommController/supprimerCommentaire", // chemin qui pointe vers le fichier .php et la fonction supprimerUtilisateur  
            type: "POST", // méthode POST envoyer l'id du client  
            data: { id_comm: id_comm }, 
            success: function(html) 
            { 
              selectedTr.fadeOut();
            } 
          });

    });
    
  });
