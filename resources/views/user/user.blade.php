<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/user.css')}}">
        <link rel = "stylesheet" href = "{{asset('css/notification.css')}}">
        <link rel = "stylesheet" href = "{{asset('css/nice-select.css')}}">
    </head>
    <body>
        <div class = "container-scroller">
            @include ('layouts.horizontal_nav')
            <div class = "container-fluid page-body-wrapper">   
                @include ('layouts.vertical_nav')
                <div class = "main-panel">
                    <div class = "content-wrapper">
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
                        <div class = "row">
                            <div class = "col-md-12 grid-margin stretch-card user">
                                <span class = "main_bg"></span>
                                <div class = "container">
                                    <section class = "userProfile card">
                                        <div class="profile">
                                            <figure><img src = "{{$informations['image']}}" alt = "Photo de profil" width = "250px" height = "250px"></figure>
                                        </div>
                                    </section>
                                    <section class = "work_skills card">
                                        <div class = "work">
                                            <h1 class = "heading">Bio</h1>
                                                <div class = "primary">
                                                    <h1>Détails de profil</h1>
                                                    <p>Ce profil est personnel. Vous pouvez modifier les informations et la photo de profil ainsi que supprimer ce compte à tout moment.</p>
                                                </div>
                                            </div>
                                    </section>
                                    <section class = "userDetails card">
                                        <div class = "userName">
                                            <h1 class = "name">{{$informations['fullname']}}</h1>
                                            <p>{{$informations['type']}} de l'application</p>
                                        </div>
                                        <div class = "rank">
                                            <h1 class = "heading">Mobile</h1>
                                            <i>(+216) {{$informations['tel']}}</i>
                                        </div>
                                        <div class = "btns">
                                            <ul>
                                                <li class = "sendMsg active">
                                                    <i class = "mdi mdi-account-circle"></i>
                                                    <a href = "{{url('/profil')}}">Profil</a>
                                                </li>
                                                <li class = "sendMsg">
                                                    <i class = "mdi mdi-tooltip-edit"></i>
                                                    <a href = "{{url('/edit-image-profil')}}">Photo</a>
                                                </li>
                                                @if (session('type') == 'Admin')
                                                    <li class = "sendMsg" onclick = "questionDeleteCompte()">
                                                        <i class = "mdi mdi-account-remove"></i>
                                                        <a href = "#">Supprimer</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </section>
                                    <section class = "timeline_about card">
                                        <div class = "tabs">
                                            <ul>
                                                <li class = "about active" onclick = "tabs(0)">
                                                    <i class = "mdi mdi-information-outline"></i>
                                                    <span>Informations</span>
                                                </li>
                                                <li class = "timelines" onclick = "tabs(1)">
                                                    <i class = "mdi mdi-security"></i>
                                                    <span>Sécurité</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class = "basic_info tab">
                                            <form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('/update-user')}}">
                                                @csrf
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-4 col-form-label">Nom</label>
                                                            <div class = "col-sm-8">
                                                                <input type = "text" class = "form-control" name = "nom" id = "nom" onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" placeholder = "Saisissez le nom.." value = "{{$informations['nom']}}"required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-4 col-form-label">Prénom</label>
                                                            <div class = "col-sm-8">
                                                                <input type = "text" class = "form-control" name = "prenom" id = "prenom" onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" placeholder = "Saisissez le prénom.." value = "{{$informations['prenom']}}" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-4 col-form-label">Genre</label>
                                                            <div class = "col-sm-8">
                                                                <select class = "nice-select" name = "genre" id = "genre" required value = "{{$informations['genre']}}">
                                                                    <option selected disabled value = "Genre">Genre</option>
                                                                    <option value = "Homme">Homme</option>
                                                                    <option value = "Femme">Femme</option>
                                                                </select>
                                                                <input type = "hidden" id = "l" value = "{{$informations['genre']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-4 col-form-label">Naissance</label>
                                                            <div class = "col-sm-8">
                                                                <input type = "date" class = "form-control" name = "naissance" id = "naissance" value = "{{$informations['naissanceF']}}" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-4 col-form-label">Mobile</label>
                                                            <div class = "col-sm-8">
                                                                <input type = "number" class = "form-control" name = "mobile" id = "mobile" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" placeholder = "Saisissez le numéro mobile.." value = "{{$informations['telF']}}" required/>
                                                            </div>
                                                            <span class = "error" id = "mobile_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-4 col-form-label">Adresse</label>
                                                            <div class = "col-sm-8">
                                                                <input type = "text" class = "form-control" name = "adresse" id = "adresse" placeholder = "Saisissez l'adresse.." value = "{{$informations['adresse']}}" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-4 col-form-label">CIN</label>
                                                            <div class = "col-sm-8">
                                                                <div class = "input-group">
                                                                    <input type = "number" class = "form-control" name = "cin" id = "cin" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" placeholder = "Saisissez le CIN.." value = "{{$informations['cin']}}" readonly required/>
                                                                </div>
                                                                <span class = "error" id = "cin_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-4 col-form-label">Type</label>
                                                            <div class = "col-sm-8">
                                                                <select class = "nice-select" name = "type" id = "type" disabled required>
                                                                    <option selected disabled>type</option>
                                                                    <option value = "User">Utilisateur</option>
                                                                    <option value = "Admin">Admin</option>
                                                                </select>
                                                                <input type = "hidden" id = "t" value = "{{$informations['type']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type = "submit" class = "btn btn-primary mr-2" id = "btn_submit">Modifier le profil</button>
                                                <button type = "button" class = "btn btn-light" onclick = "viderUpdateCompte()">Annuler</button>
                                            </form>
                                        </div>
                                        <div class = "contact_Info tab">
                                            <form class = "forms-sample" id = "f2" name = "f2" method = "post" action = "{{url('/update-password')}}">
                                                @csrf
                                                <div class = "form-group row">
                                                    <label for = "exampleInputUsername2" class = "col-sm-4 col-form-label">Ancien mot de passe</label>
                                                    <div class = "col-sm-8">
                                                        <input type = "password" class = "form-control" id = "old" name = "old" placeholder = "Saisissez votre ancien mot de passe.." required>
                                                    </div>
                                                </div>
                                                <div class = "form-group row">
                                                    <label for = "exampleInputUsername2" class = "col-sm-4 col-form-label">Nouveau mot de passe</label>
                                                    <div class = "col-sm-8">
                                                        <input type = "password" class = "form-control" id = "new" name = "new" placeholder = "Saisissez votre nouveau mot de passe.." required>
                                                    </div>
                                                </div>
                                                <button type = "submit" class = "btn btn-primary mr-2" id = "btn_submit">Modifier le mot de passe</button>
                                                <button type = "reset" class = "btn btn-light">Annuler</button>
                                            </form>
                                        </div>
                                    </section>
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
        <script src = "{{asset('js/change_tab.js')}}"></script>
        <script>
            $(function(){
                $("#genre").val($('#l').val()).change();
                $("#type").val($('#t').val()).change(); 
                configSelect($('#genre'));
                configSelect($('#type'));
                updateSelect($('#genre'));
            });

            $('#mobile').on('input',function(){
                initialiserMobile($('#mobile_error'));
            });    

            $('#f').submit(function() {
                validerChampsMobile($('#mobile').val(),$('#mobile_error'));
         	});

             $('#f2').submit(function() {
				$('#btn_submit').prop('disabled', true);
                $("#f2").submit();
         	});
        </script>
    </body>
</html>