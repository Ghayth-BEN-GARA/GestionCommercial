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
                    $('#btn-submit').prop('disabled', true);
                }   
    
                else{
                    $('#cin_error').val('');
                    $('#btn-submit').prop('disabled', false);
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
                    $('#btn-submit').prop('disabled', false);
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
        $('#paye').prop('disabled', true);
    }

    else if($('#tranche').is(':checked')) { 
        $('#paye').prop('disabled', false);
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

function searchReferenceFacture(){
    $('#referenceF').typeahead({
        source: function(query, process) {
            return $.get('/autocomplete-reference-facture', { query: query }, function(data) {
                return process(JSON.parse(data));
            });
        }
    });
}

function searchDesignationFacture(compteur){
    $('#designation' + compteur).typeahead({
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
                    $('#designation' + compteur).val(item);
                    $('#reference' + compteur).val(data.reference);
                    $('#categorie' + compteur).val(data.categorie);
                    $('#designation' + compteur).prop('readonly', true);
                    $('#reference' + compteur).prop('readonly', true);
                    $('#categorie' + compteur).prop('readonly', true);
                }
            })
        }
    });
}

function searchReferenceFacture(compteur){
    $('#reference' + compteur).typeahead({
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
                    $('#reference' + compteur).val(item);
                    $('#designation' + compteur).val(data.designation);
                    $('#categorie' + compteur).val(data.categorie);
                    $('#designation' + compteur).prop('readonly', true);
                    $('#reference' + compteur).prop('readonly', true);
                    $('#categorie' + compteur).prop('readonly', true);
                }
            })
        }
    });
}

function searchCategorieFacture(compteur){
    $('#categorie' + compteur).typeahead({
        source: function(query, process) {
            return $.get('/autocomplete-categorie-facture', { query: query }, function(data) {
                return process(JSON.parse(data));
            });
        }
    });
}