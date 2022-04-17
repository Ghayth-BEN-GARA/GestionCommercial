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
                                        <h4 class = "card-title">Compte</h4>
                                        <p class = "card-description">Créer un compte</p>
                                        <form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('/add-personne')}}" enctype = "multipart/form-data">
                                            @csrf    
                                            <div class = "row">
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-3 col-form-label">Nom</label>
                                                        <div class = "col-sm-9">
                                                            <input type = "text" class = "form-control" name = "nom" id = "nom" onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" placeholder = "Saisissez le nom.." required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-3 col-form-label">Prénom</label>
                                                        <div class = "col-sm-9">
                                                            <input type = "text" class = "form-control" name = "prenom" id = "prenom" onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" placeholder = "Saisissez le prénom.." required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "row">
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-3 col-form-label">Genre</label>
                                                        <div class = "col-sm-9">
                                                            <select class = "form-control" name = "genre" id = "genre" required>
                                                                <option selected disabled>Genre</option>
                                                                <option>Homme</option>
                                                                <option>Femme</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-3 col-form-label">Naissance</label>
                                                        <div class = "col-sm-9">
                                                            <input type = "date" class = "form-control" name = "naissance" id = "naissance" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "row">
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-3 col-form-label">Mobile</label>
                                                        <div class = "col-sm-9">
                                                            <input type = "number" class = "form-control" name = "mobile" id = "mobile" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" placeholder = "Saisissez le numéro mobile.." required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-3 col-form-label">Adresse</label>
                                                        <div class = "col-sm-9">
                                                            <input type = "text" class = "form-control" name = "adresse" id = "adresse" placeholder = "Saisissez l'adresse.." required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "row">
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-3 col-form-label">CIN</label>
                                                        <div class = "col-sm-9">
                                                            <div class = "input-group">
                                                                <input type = "number" class = "form-control" name = "cin" id = "cin" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" placeholder = "Saisissez le CIN.." required/>
                                                                <div class = "input-group-append">
                                                                    <button class = "btn btn-sm btn-primary" type = "button">Vérifier</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-3 col-form-label">Password</label>
                                                        <div class = "col-sm-9">
                                                            <input type = "text" class = "form-control" name = "password" id = "password" placeholder = "Saisissez le mot de passe.." required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "row">
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-3 col-form-label">Type</label>
                                                        <div class = "col-sm-9">
                                                            <select class = "form-control" name = "type" id = "type" required>
                                                                <option selected disabled>type</option>
                                                                <option>Utilisateur</option>
                                                                <option>Admin</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "col-md-6">
                                                    <div class = "form-group row">
                                                        <label class = "col-sm-3 col-form-label">Image</label>
                                                        <div class = "col-sm-9">
                                                            <input type = "file" class = "file-upload-default" name = "img[]" id = "image" required/>
                                                            <div class = "input-group col-xs-12">
                                                                <input type = "text" class ="form-control file-upload-info" disabled placeholder = "Séléctionner une image">
                                                                <span class = "input-group-append">
                                                                    <button class = "file-upload-browse btn btn-primary" type = "button">Séléctionner</button>
                                                                </span>
                                                            </div>
                                                            <br>
                                                            <p class = "card-description">(Image <b>JPEG</b> uniquement)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type = "submit" class = "btn btn-primary mr-2" disabled>Créer un compte</button>
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
        <script src = "{{asset('js/file-upload.js')}}"></script>
    </body>
</html>