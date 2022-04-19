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