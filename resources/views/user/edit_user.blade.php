<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/profil.css')}}">
        <link rel = "stylesheet" href = "{{asset('css/nice-select.css')}}">
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
                                <div class = "col-md-3">
                                    <div class = "osahan-account-page-left shadow-sm bg-white h-100">
                                        <div class = "border-bottom p-4">
                                            <div class = "osahan-user text-center">
                                                <div class = "osahan-user-media">
                                                    <img class = "mb-3 rounded-pill shadow-sm mt-1" src = "{{$informations['image']}}" alt = "gurdeep singh osahan">
                                                    <div class = "osahan-user-media-body">
                                                        <h6 class = "mb-2">{{$informations['fullname']}}</h6>
                                                        <p class = "mb-1">{{$informations['tel']}}</p>
                                                        <p>{{$informations['cin']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class = "nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id = "myTab" role = "tablist">
                                            <li class = "nav-item">
                                                <a href = "{{url('/edit-user')}}" class = "nav-link" id = "payments-tab" role = "tab" aria-controls = "payments" aria-selected = "true"><i class = "mdi mdi-account-edit"></i> Modifier compte</a>
                                            </li>
                                            <li class = "nav-item">
                                                <a href = "{{url('/edit-image-profil')}}" class = "nav-link" id = "payments-tab" role = "tab" aria-controls = "payments" aria-selected = "true"><i class = "mdi mdi-file-image"></i> Modifier l'image</a>
                                            </li>
                                            <li class = "nav-item">
                                                <a href = "{{url('/edit-password-profil')}}" class = "nav-link" id = "payments-tab" role = "tab" aria-controls = "payments" aria-selected = "true"><i class = "mdi mdi-lock"></i> Modifier Password</a>
                                            </li>
                                            @if (session('type') == 'Admin')
                                                <li class = "nav-item">
                                                    <a href = "javascript:void(0)" class = "nav-link" id = "payments-tab" role = "tab" aria-controls = "payments" aria-selected = "true" onclick = "questionDeleteCompte()"><i class = "mdi mdi-account-remove"></i> Supprimer le compte</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class = "col-md-9">
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
                                    <div class = "osahan-account-page-right shadow-sm bg-white p-4 h-100">
                                        <div class = "tab-content" id = "myTabContent">
                                            <div class = "tab-pane fade active show" id = "payments" role = "tabpanel" aria-labelledby = "payments-tab">
                                                <form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('/update-user')}}">
                                                    @csrf
                                                    <div class = "row">
                                                        <div class = "col-md-6">
                                                            <div class = "form-group row">
                                                                <label class = "col-sm-3 col-form-label">Nom</label>
                                                                <div class = "col-sm-9">
                                                                    <input type = "text" class = "form-control" name = "nom" id = "nom" onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" placeholder = "Saisissez le nom.." value = "{{$informations['nom']}}"required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class = "col-md-6">
                                                            <div class = "form-group row">
                                                                <label class = "col-sm-3 col-form-label">Prénom</label>
                                                                <div class = "col-sm-9">
                                                                    <input type = "text" class = "form-control" name = "prenom" id = "prenom" onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" placeholder = "Saisissez le prénom.." value = "{{$informations['prenom']}}" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class = "row">
                                                        <div class = "col-md-6">
                                                            <div class = "form-group row">
                                                                <label class = "col-sm-3 col-form-label">Genre</label>
                                                                <div class = "col-sm-9">
                                                                    <select class = "nice-select" name = "genre" id = "genre" required value = "{{$informations['genre']}}">
                                                                        <option selected disabled>Genre</option>
                                                                        <option value = "Homme">Homme</option>
                                                                        <option value = "Femme">Femme</option>
                                                                    </select>
                                                                    <input type = "hidden" id = "l" value = "{{$informations['genre']}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class = "col-md-6">
                                                            <div class = "form-group row">
                                                                <label class = "col-sm-3 col-form-label">Naissance</label>
                                                                <div class = "col-sm-9">
                                                                    <input type = "date" class = "form-control" name = "naissance" id = "naissance" value = "{{$informations['naissanceF']}}" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class = "row">
                                                        <div class = "col-md-6">
                                                            <div class = "form-group row">
                                                                <label class = "col-sm-3 col-form-label">Mobile</label>
                                                                <div class = "col-sm-9">
                                                                    <input type = "number" class = "form-control" name = "mobile" id = "mobile" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" placeholder = "Saisissez le numéro mobile.." value = "{{$informations['telF']}}" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class = "col-md-6">
                                                            <div class = "form-group row">
                                                                <label class = "col-sm-3 col-form-label">Adresse</label>
                                                                <div class = "col-sm-9">
                                                                    <input type = "text" class = "form-control" name = "adresse" id = "adresse" placeholder = "Saisissez l'adresse.." value = "{{$informations['adresse']}}" required/>
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
                                                                    <input type = "number" class = "form-control" name = "cin" id = "cin" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" placeholder = "Saisissez le CIN.." value = "{{$informations['cin']}}" readonly required/>
                                                                    </div>
                                                                    <span class = "error" id = "cin_error"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class = "col-md-6">
                                                            <div class = "form-group row">
                                                                <label class = "col-sm-3 col-form-label">Type</label>
                                                                <div class = "col-sm-9">
                                                                    <select class = "nice-select" name = "type" id = "type" disabled required>
                                                                        <option selected disabled>type</option>
                                                                        <option value = "Utilisateur">Utilisateur</option>
                                                                        <option value = "Admin">Admin</option>
                                                                    </select>
                                                                    <input type = "hidden" id = "t" value = "{{$informations['type']}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type = "submit" class = "btn btn-primary mr-2" id = "btn_submit">Modifier le profil</button>
                                                    <button type = "reset" class = "btn btn-light">Annuler</button>
                                                </form>
                                            </div>
                                        </div>
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
        <script src = "{{asset('js/jquery.nice-select.js')}}"></script>
        <script>
            $(function(){
                $("#genre").val($('#l').val()).change();
                $("#type").val($('#t').val()).change(); 
                configSelect($('#genre'));
                configSelect($('#type'));
                updateSelect($('#genre'));
            });

            $('#f').submit(function() {
				$('#btn_submit').prop('disabled', true);
                $("#f").submit();
         	});
        </script>
    </body>
</html>