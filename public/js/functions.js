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