<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/notification.css')}}">
    </head>
    <body>
        <div class = "container-scroller">
            @include ('layouts.horizontal_nav')
            <div class = "container-fluid page-body-wrapper">   
                @include ('layouts.vertical_nav')
                <div class = "main-panel">
                    <div class = "content-wrapper">
                        <div class = "row">
                            <div class = "col-md-12 grid-margin stretch-card">
                                <div class = "card">
                                    <div class = "card-body">
                                        <h4 class = "card-title">Client</h4>
                                        @if (Session::has('erreur'))
                                            <div class = "alert bg-danger mb-5 py-4" role = "alert">
                                                <div class = "d-flex">
                                                    <div class = "px-3">
                                                        <p class = "phrase">{{session()->get('erreur')}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif (Session::has('success'))
                                            <div class = "alert bg-success mb-5 py-4" role = "alert">
                                                <div class = "d-flex">
                                                    <div class = "px-3">
                                                        <p class = "phrase2">{{session()->get('success')}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <p class = "card-description">Modifier un client</p>
                                        <form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('/update-client')}}">
                                            @csrf    
                                            <div class = "row">
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-4 col-form-label">Matricule ou CIN</label>
                                                        <div class = "col-sm-8">
                                                            <input type = "text" class = "form-control" name = "matricule" id = "matricule" placeholder = "Saisissez la matricule fiscale ou le CIN.." value = "{{$client->getMatriculeAttribute()}}" required readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-4 col-form-label">Nom et prénom</label>
                                                        <div class = "col-sm-8">
                                                            <input type = "text" class = "form-control" name = "nom" id = "nom" onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" placeholder = "Saisissez le nom.." value = "{{$client->getFullnameAttribute()}}" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "row">
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-4 col-form-label">Email</label>
                                                        <div class = "col-sm-8">
                                                            <input type = "email" class = "form-control" name = "email" id = "email" placeholder = "Saisissez l'adresse e-mail.." value = "{{$client->getEmailAttribute()}}" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-4 col-form-label">Adresse</label>
                                                        <div class = "col-sm-8">
                                                            <input type = "text" class = "form-control" name = "adresse" id = "adresse" placeholder = "Saisissez l'adresse.." value = "{{$client->getAdresseAttribute()}}" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "row">
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-4 col-form-label">Mobile</label>
                                                        <div class = "col-sm-8">
                                                            <input type = "number" class = "form-control" name = "tel1" id = "tel1" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" placeholder = "Saisissez le numéro mobile.." value = "{{$client->getTel1Attribute()}}"  required/>
                                                        </div>
                                                        <span class = "error" id = "mobile1_error"></span>
                                                    </div>
                                                </div>
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-4 col-form-label">Mobile (optionnel)</label>
                                                        <div class = "col-sm-8">
                                                            <input type = "number" class = "form-control" name = "tel2" id = "tel2" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" placeholder = "Saisissez le numéro mobile.." value = "{{$client->getTel2Attribute()}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type = "submit" class = "btn btn-primary mr-2" id = "btn_submit">Modifier un client</button>
                                            <button type = "button" class = "btn btn-light" onclick = "viderUpdateClient()">Annuler</button>
                                        </form>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    @include ('layouts.footer')
                </div>
            </div>
        </div>
        @include ('layouts.script_vente')
        <script>
            $('#f').submit(function() {
				$('#btn_submit').prop('disabled', true);
                $("#f").submit();
         	});
        </script>
    </body>
</html>