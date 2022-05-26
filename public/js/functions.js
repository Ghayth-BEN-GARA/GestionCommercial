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
    $('#btn_submit').prop('disabled', true);
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
     $('#des').typeahead({
        minLength: 1,
        source: function(query, process) {
            return $.get('/autocomplete-designation-facture', { query: query }, function(data) {
                return process(JSON.parse(data));
            });
        },
        updater: function(item) {
            $.ajax({
                url: '/get-data-article',
                type: "get",
                cache: false,
                dataType: 'json',
                data: { designation: item },
                success: function(data) {
                    $('#des').val(item);
                    $('#ref').val(data.reference);
                    $('#cat').val(data.categorie);
                    $('#des').prop('readonly', true);
                    $('#ref').prop('readonly', true);
                    $('#cat').prop('readonly', true);
                }
            });
        }
    });
}

function searchReferenceFacture(){
    $('#ref').typeahead({
        source: function(query, process) {
            return $.get('/autocomplete-reference-facture', { query: query }, function(data) {
                return process(JSON.parse(data));
            });
        },
        updater: function(item) {
            $.ajax({
                url: '/get-data-article',
                type: "get",
                cache: false,
                dataType: 'json',
                data: { reference: item },
                success: function(data) {
                    $('#ref').val(item);
                    $('#des').val(data.designation);
                    $('#cat').val(data.categorie);
                    $('#des').prop('readonly', true);
                    $('#ref').prop('readonly', true);
                    $('#cat').prop('readonly', true);
                }
            })
        }
    });
}

function searchCategorieFacture(){
    $('#cat').typeahead({
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
    if($('#des').val() == '' || $('#ref').val() == '' || $('#cat').val() == '' || $('#qte').val() == '' || $('#pr').val() == ''){
        afficherErreur("Vous n'avez pas rempli correctement les champs..");
    }

    else{
        
    }

}


  
