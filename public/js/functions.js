function questionDeconnexion() {
    swal({
        title: "Déconnexion ?",
        text: "Votre compte se fermera automatiquement..",
        type: 'warning',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: '#F7941E',
        confirmButtonText: "Déconnecter",
        cancelButtonText: 'Annuler'
    })

    .then((result) => {
        if (result.value) {
            chargement('Déconnexion..').then(ouvrirRoot("/logout"));
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swal.close();
        }
    });
}

async function chargement(message) {
    swal({
        text: message,
        allowEscapeKey: false,
        allowOutsideClick: false,
        padding: "2em",
        width: "350px",
        onOpen: () => {
            swal.showLoading();
        }
    })
}

function ouvrirRoot(root) {
    location.href = root;
}

function verifierCompte(){
    if(document.getElementById('cin').value == ''){
        $('#cin_error').html('Veuillez entrer un CIN..');
        $('#btn_submit').prop('disabled', true);
    }

    else{
        $.ajax({
            url: '/verify-cin-user',
            type: "get",
            cache: true,
            data: { cin: $('#cin').val() },
            success: function(data) {
                if(data.trim() == 'admin'){
                    $('#cin_error').html('Veuillez entrer un CIN valide..');
                    $('#btn_submit').prop('disabled', true);
               }
    
                else if(data.trim() == false){
                    $('#cin_error').html('Un autre compte est déjà créé avec ce CIN..');
                    $('#btn_submit').prop('disabled', true);
                }   
    
                else{
                    $('#cin_error').val('');
                    $('#btn_submit').prop('disabled', false);
                }
            }
        })
    }
}

function initialiserCIN(){
    $('#cin_error').html('');
    $('#btn-submit').prop('disabled', true);
}

function questionDeleteImage(){
    swal({
        title: "Supprimer l'image ?",
        text: "Votre photo de profil sera supprimée automatiquement..",
        type: 'warning',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: '#F7941E',
        confirmButtonText: "Supprimer",
        cancelButtonText: 'Annuler'
    })

    .then((result) => {
        if (result.value) {
            chargement('Suppression..').then(ouvrirRoot("/delete-image"));
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swal.close();
        }
    });
}

function questionDeleteCompte(){
    swal({
        title: "Supprimer votre compte ?",
        text: "Votre compte sera supprimée automatiquement..",
        type: 'warning',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: '#F7941E',
        confirmButtonText: "Supprimer",
        cancelButtonText: 'Annuler'
    })

    .then((result) => {
        if (result.value) {
            chargement('Suppression..').then(ouvrirRoot("/delete-user"));
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swal.close();
        }
    });
}

function questionSupprimerUser(cin){
    swal({
        title: "Supprimer cet utilisateur ?",
        text: "cet utilisateur sera supprimée automatiquement..",
        type: 'warning',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: '#F7941E',
        confirmButtonText: "Supprimer",
        cancelButtonText: 'Annuler'
    })

    .then((result) => {
        if (result.value) {
            chargement('Suppression..').then(ouvrirRoot("/delete-utilisateur/"+cin));
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swal.close();
        }
    });
}

function verifierReferenceFacture(){
    if(document.getElementById('referenceF').value == ''){
        $('#referenceF_error').html('Veuillez entrer une référence..');
        $('#btn_submit').prop('disabled', true);
    }

    else{
        $.ajax({
            url: '/verify-reference-facture',
            type: "get",
            cache: true,
            data: { referenceF: $('#referenceF').val() },
            success: function(data) {
                if(data.trim() == false){
                    $('#referenceF_error').html('Une autre facture est déjà créé avec cette référence..');
                    $('#btn_submit').prop('disabled', true);
                }   
    
                else{
                    $('#referenceF_error').val('');
                    $('#btn_submit').prop('disabled', false);
                }
            }
        })
    }
}

function initialiserMatricule(){
    $('#matricule_error').html('');
    $('#btn-submit').prop('disabled', true);
}

function verifierMatriculeFournisseur(){
    if(document.getElementById('matricule').value == ''){
        $('#matricule_error').html('Veuillez entrer une matricule fiscale..');
        $('#btn_submit').prop('disabled', true);
    }

    else{
        $.ajax({
            url: '/verify-matricule',
            type: "get",
            cache: true,
            data: { matricule: $('#matricule').val() },
            success: function(data) {
                if(data.trim() == false){
                    $('#matricule_error').html('Un autre fournisseur est déjà créé avec cette matricule..');
                    $('#btn-submit').prop('disabled', true);
                }   
    
                else{
                    $('#matricule_error').val('');
                    $('#btn_submit').prop('disabled', false);
                }
            }
        })
    }
}

function setMatriculeFournisseur() {
    $.ajax({
        url: '/get-matricule-fournisseur',
        type: "get",
        cache: true,
        data: { nom: $('#nom').val() },
        success: function(data) {
            $('#matricule').val(data.trim());
        }
    })
}

function enabledDisabledMontantPaye(){
    if($('#totale').is(':checked')) { 
        $('#paye').prop('readonly', true);
    }

    else if($('#tranche').is(':checked')) { 
        $('#paye').prop('readonly', false);
    }
}

function initialiserReferenceF(){
    $('#referenceF_error').html('');
    $('#referenceF_error2').html('');
}

function validerFacture(){
    var nomFournisseur = document.getElementById('nom').selectedIndex;
    var typeFacture = document.getElementById('type').selectedIndex;

   if((nomFournisseur == 0) || (typeFacture == 0)){
       afficherErreur('Aucun type de facture et / ou fournisseur spécifié(s)..');
       event.preventDefault();
    }

    else{
        $("#f").submit();
    }
}

function afficherErreur(message) {
    swal({
        type: "error",
        title: "Oups !",
        html: message,
        width: 500,
        padding: '2em',
        showCancelButton: true,
        cancelButtonText: "Fermer",
        focusCancel: false,
        popup: 'animated fadeInDown faster',
        showConfirmButton: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        scrollbarPadding: true,
        allowOutsideClick: false
    })
}

function searchDesignationFacture(){
     $('#designationAdd').typeahead({
        source: function(query, process) {
            return $.get('/autocomplete-designation-facture', { query: query }, function(data) {
                return process(JSON.parse(data));
            });
        },
        updater: function(item) {
            $.ajax({
                url: '/get-data-article',
                type: "get",
                cache: true,
                dataType: 'json',
                data: { designation: item },
                success: function(data) {
                    $('#designationAdd').val(item);
                    $('#referenceAdd').val(data.reference);
                    $('#categorieAdd').val(data.categorie);
                    $('#designationAdd').prop('readonly', true);
                    $('#referenceAdd').prop('readonly', true);
                    $('#categorieAdd').prop('readonly', true);
                }
            });
        }
    });
}

function searchReferenceFacture(){
    $('#referenceAdd').typeahead({
        source: function(query, process) {
            return $.get('/autocomplete-reference-facture', { query: query }, function(data) {
                return process(JSON.parse(data));
            });
        },
        updater: function(item) {
            $.ajax({
                url: '/get-data-article',
                type: "get",
                cache: true,
                dataType: 'json',
                data: { reference: item },
                success: function(data) {
                    $('#referenceAdd').val(item);
                    $('#designationAdd').val(data.designation);
                    $('#categorieAdd').val(data.categorie);
                    $('#designationAdd').prop('readonly', true);
                    $('#referenceAdd').prop('readonly', true);
                    $('#categorieAdd').prop('readonly', true);
                }
            })
        }
    });
}

function searchCategorieFacture(){
    $('#categorieAdd').typeahead({
        source: function(query, process) {
            return $.get('/autocomplete-categorie-facture', { query: query }, function(data) {
                return process(JSON.parse(data));
            });
        }
    });
}

function validerFormulaireAddUser(){
    var genreUser = document.getElementById('genre').selectedIndex;
    var typeUser = document.getElementById('type').selectedIndex;

    if((genreUser == 0) || (typeUser == 0)){
        afficherErreur("Aucun genre et / ou type d'utilisateur spécifié(s)..");
        event.preventDefault();
    }

    else{
        $('#btn_submit').prop('disabled', true);
        $("#f").submit();
    }
}

function validerFormulaireAddArticle(){
    var categorie = document.getElementById('categorie').selectedIndex;

    if(categorie == 0){
        afficherErreur("Aucune catégorie d'article spécifié..");
        event.preventDefault();
    }
 
    else{
        $('#btn_submit2').prop('disabled', true);
        $("#f2").submit();
    }
}

function questionSupprimerFacture(referenceF){
    swal({
        title: "Supprimer cette facture ?",
        text: "cette facture sera supprimée automatiquement..",
        type: 'warning',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: '#F7941E',
        confirmButtonText: "Supprimer",
        cancelButtonText: 'Annuler'
    })

    .then((result) => {
        if (result.value) {
            chargement('Suppression..').then(ouvrirRoot('/delete-facture?reference='+referenceF));
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swal.close();
        }
    });
}

function imprimFacture(){
    window.print();
}

function configSelect(input) {
    input.niceSelect();
}

function updateSelect(input){
    input.niceSelect('update');
}

function validerChampsMobile(input,erreur){
    if(input.length != 8){
        erreur.html('Votre numéro de téléphone mobile doit être composé de 8 chiffres..');
        erreur.show();
        event.preventDefault();
    }

    else{
        $('#btn_submit').prop('disabled', true);
        $("#f").submit();
    }
}

function initialiserMobile(erreur){
    erreur.html('');
}

function viderUpdateCompte(){
    viderChamps($('#nom'));
    viderChamps($('#prenom'));
    $('#genre').val('Genre'); 
    updateSelect($('#genre'));
    viderChamps($('#naissance'));
    viderChamps($('#mobile'));
    viderChamps($('#adresse'));
}

function viderChamps(input){
    input.val('');
}

function viderUpdateFournisseur(){
    viderChamps($('#nom'));
    viderChamps($('#email'));
    viderChamps($('#adresse'));
    viderChamps($('#mobile1'));
    viderChamps($('#mobile2'));
}

function ouvrirRootEditReglement(matricule){
    ouvrirRoot('/edit-reglement?matricule='+ matricule);
}

function functionEnabledDisabledMontantPaye(){
    $('.paiement').on('click', function(){
        enabledDisabledMontantPaye();
    });  
}

function gestionAjouterLigne(){
    if($('#designationAdd').val() == '' || $('#referenceAdd').val() == '' || $('#categorieAdd').val() == '' || $('#quantiteAdd').val() == '' || $('#prixAdd').val() == ''){
        afficherErreur("Vous n'avez pas rempli correctement les champs..");
    }

    else if($('#designationAdd').val() == 'Désignation' || $('#referenceAdd').val() == 'Référence' || $('#categorieAdd').val() == 'Catégorie' || $('#quantiteAdd').val() == 'Quantité' || $('#prixAdd').val() == '0.000'){
        afficherErreur("Veuillez entrer une ligne valide..");
    }

    else{
        deleteEmptyLigne();
        ajouterLigne($('#designationAdd').val(),$('#referenceAdd').val(),$('#categorieAdd').val(),$('#quantiteAdd').val(),$('#prixAdd').val(),calculerPrixTotale($('#quantiteAdd').val(),$('#prixAdd').val()));
        clearData();
        enableInputs();
        checkIfButtonActive();
    }
}

function clearData(){
    $('#designationAdd').val('Désignation');
    $('#referenceAdd').val('Référence');
    $('#categorieAdd').val('Catégorie');
    $('#quantiteAdd').val('0');
    $('#prixAdd').val('0.000');
}

function enableInputs(){
    $('#designationAdd').prop('readonly', false);
    $('#referenceAdd').prop('readonly', false);
    $('#categorieAdd').prop('readonly', false);
    $('#quantiteAdd').prop('readonly', false);
    $('#prixAdd').prop('readonly', false);
}

function ajouterLigne(designation,reference,categorie,quantite,prix,prixTotale){
    $('.table #body_achat').last().after(
        '<tr>'+
            '<td><input type = "text" class = "form-control" name = "designation[]" value = "'+designation+'" readonly></td>' +
            '<td><input type = "text" class = "form-control" name = "reference[]" value = "'+reference+'" readonly></td>' +
            '<td><input type = "text" class = "form-control" name = "categorie[]" value = "'+categorie+'" readonly></td>' +
            '<td><input type = "text" class = "form-control" name = "quantite[]" value = "'+quantite+'" readonly></td>' +
            '<td><input type = "text" class = "form-control" name = "prix[]" value = "'+prix+'" readonly></td>' +
            '<td class = "styleInput"><span id = "prixTotale" name = "prixT[]">'+prixTotale+' DT</span></td>'+
            '<td><button type = "button" class = "btn btn-danger float-right mr-2 mt-4" name = "button_delete" onclick = "gestionDeleteLigne(this)">Supprimer</button></td>'+
        '</tr>'
    );
}

function calculerPrixTotale(quantite,prix){
    var totale = prix * quantite;
    var strlen = totale.toString().length;

    if(totale == 0){
        return '0';
    }

    else if(strlen < 4){
        return '0.' + totale;
    }

    else{
        var ch1 = totale.toString().substring(strlen-3,strlen);
        var ch2 = totale.toString().substring(0,strlen-3);
        return ch2 + '.' + ch1;
    }
}

function deleteLigne(element){
    element.closest('tr').remove();      
}

function createEmptyAchat(){
    $(".table #body_achat").last().after(
        "<tr id = 'vide'>"+
            "<td colspan = '7'>Votre facture d'achat est encore vide..</td>"+
        "</tr>"
    );
}

function gestionDeleteLigne(element){
    if($('table tr').length >2){
        deleteLigne(element);
    }

    else if($('table tr').length == 2){
        deleteLigne(element);
        createEmptyAchat();
        $('#btn_submit').prop('disabled', true);
    }
}

function deleteEmptyLigne(){
    $("#vide").remove();
}

function checkIfButtonActive(){
    if($("#btn_submit").is(":disabled")){
        $('#btn_submit').prop('disabled', false);
    }
}

function saisieAutomatiquePrix(){
   if($('#select').is(':checked')){
    $('#prix').val($('#default').val());
    $('#prix').prop('readonly', true);
    }

    else{
        $('#prix').val('');
        $('#prix').prop('readonly', false);
    }
}

function setDataToUpdateMarge(reference){
    $('#reference').val(reference);
}




  
