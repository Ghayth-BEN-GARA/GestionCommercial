function verifierMatriculeCINClient(){
    if(document.getElementById('matricule').value == ''){
        $('#matricule_cin_error').html('Veuillez entrer une matricule fiscale ou CIN..');
        $('#btn_submit').prop('disabled', true);
    }

    else{
        $.ajax({
            url: '/verify-matricule-cin',
            type: 'get',
            cache: true,
            data: { matricule: $('#matricule').val() },
            success: function(data) {
                if(data.trim() == false){
                    $('#matricule_cin_error').html('Un autre client est déjà créé avec cette matricule ou CIN..');
                    $('#btn_submit').prop('disabled', true);
                }   
    
                else{
                    $('#matricule_cin_error').val('');
                    $('#btn_submit').prop('disabled', false);
                }
            }
        })
    }
}

function initialiserMatriculeCIN(){
    $('#matricule_cin_error').html('');
    $('#btn_submit').prop('disabled', true);
}