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
                                            <div class = "map">
                                                <i class = "mdi mdi-crosshairs-gps"></i>
                                                <span>{{$informations['adresse']}}, Tunisia</span>
                                            </div>
                                            <p>{{$informations['type']}} de l'application</p>
                                        </div>
                                        <div class = "rank">
                                            <h1 class = "heading">Mobile</h1>
                                            <i>(+216) {{$informations['tel']}}</i>
                                        </div>
                                        <div class = "btns">
                                            <ul>
                                                <li class = "sendMsg">
                                                    <i class = "mdi mdi-account-circle"></i>
                                                    <a href = "{{url('/profil')}}">Profil</a>
                                                </li>
                                                <li class = "sendMsg active">
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
                                        <div class = "basic_info tab">
                                            <p class = "delete-im mt-4">Si vous le souhaitez, vous pouvez supprimer votre photo de profil en cliquant sur<a href = "javascript:void(0)" onclick = "questionDeleteImage()" style = "text-decoration: none; color:#F7941E;font-weight:bold;"> Supprimer l'image</a></p>
                                            <form class = "forms-sample mt-4" id = "f" name = "f" method = "post" action = "{{url('/update-image')}}" enctype = "multipart/form-data">
                                                @csrf    
                                                <div class = "form-group">
                                                    <input type = "file" class = "file-upload-default" name = "image" id = "image" required required accept = "image/jpeg">
                                                    <div class = "input-group col-xs-12">
                                                        <input type = "text" class = "form-control file-upload-info" disabled placeholder = "Modifier l'image de profil..">
                                                        <span class = "input-group-append">
                                                            <button class = "file-upload-browse btn btn-primary" type = "button">Modifier</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <button type = "submit" class = "btn btn-primary mr-2" id = "btn_submit">Modifier l'image de profil</button>
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
        <script src = "{{asset('js/file-upload.js')}}"></script>
        <script>
            $('#f').submit(function() {
				$('#btn_submit').prop('disabled', true);
                $("#f").submit();
         	});
        </script>
    </body>
</html>