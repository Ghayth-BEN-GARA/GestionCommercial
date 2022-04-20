<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
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
                                        <h4 class = "card-title">Fournisseur</h4>
                                        @if (Session::has('erreur'))
                                            <div class = "container">
                                                <div class = "alert alert-danger alert-dismissible fade show" role = "alert">
                                                    <p><strong>Désolé !</strong> {{session()->get('erreur')}}</p>
                                                    <button type = "button" class = "close" data-dismiss = "alert" aria-label = "Close">
                                                        <span aria-hidden = "true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                        @elseif (Session::has('success'))
                                            <div class = "container">
                                                <div class = "alert alert-success alert-dismissible fade show" role = "alert">
                                                    <p><strong>Trés bien !</strong> {{session()->get('success')}}</p>
                                                    <button type = "button" class = "close" data-dismiss = "alert" aria-label = "Close">
                                                        <span aria-hidden = "true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <p class = "card-description">Créer un forunisseur</p>
                                        <form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('creer-fournisseur')}}">
                                            @csrf    
                                            <div class = "row">
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-4 col-form-label">Matricule</label>
                                                        <div class = "col-sm-8">
                                                            <div class = "input-group">
                                                                <input type = "text" class = "form-control" name = "matricule" id = "matricule" placeholder = "Saisissez la matricule fiscale.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32) || (event.charCode>=48 && event.charCode<=57)"" required/>
                                                                <div class = "input-group-append">
                                                                    <button class = "btn btn-sm btn-primary" type = "button" onclick = "verifierMatriculeFournisseur()">Vérifier</button>
                                                                </div>
                                                            </div>
                                                            <span class = "error" id = "matricule_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-4 col-form-label">Nom</label>
                                                        <div class = "col-sm-8">
                                                            <input type = "text" class = "form-control" name = "nom" id = "nom" onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123)" placeholder = "Saisissez le nom.." required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "row">
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-4 col-form-label">Email</label>
                                                        <div class = "col-sm-8">
                                                            <input type = "email" class = "form-control" name = "email" id = "email" placeholder = "Saisissez l'adresse e-mail.." required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-4 col-form-label">Adresse</label>
                                                        <div class = "col-sm-8">
                                                            <input type = "text" class = "form-control" name = "adresse" id = "adresse" placeholder = "Saisissez l'adresse.." required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "row">
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-4 col-form-label">Mobile</label>
                                                        <div class = "col-sm-8">
                                                            <input type = "number" class = "form-control" name = "mobile1" id = "mobile1" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" placeholder = "Saisissez le numéro mobile.." required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-4 col-form-label">Mobile (optionnel)</label>
                                                        <div class = "col-sm-8">
                                                            <input type = "number" class = "form-control" name = "mobile2" id = "mobile2" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" placeholder = "Saisissez le numéro mobile.."/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type = "submit" class = "btn btn-primary mr-2" disabled id = "btn-submit">Créer un fournisseur</button>
                                            <button type = "reset" class = "btn btn-light">Annuler</button>
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
        @include ('layouts.script')
        <script>
            $('#matricule').on('input',function(){
                initialiserMatricule();
            });
        </script>
    </body>
</html>