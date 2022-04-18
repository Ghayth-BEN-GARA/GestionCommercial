<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/profil.css')}}">
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
                                                        <p class = "mb-0 text-black font-weight-bold"><a href = "{{url('/edit-user')}}" class = "text-primary mr-3" data-target = "#edit-profile-modal"><i class = "mdi mdi-account-edit"></i> MODIFIER</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class = "nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id = "myTab" role = "tablist">
                                            <li class = "nav-item">
                                                <a href = "{{url('/edit-image-profil')}}" class = "nav-link active" id = "payments-tab" role = "tab" aria-controls = "payments" aria-selected = "true"><i class = "mdi mdi-file-image"></i> Modifier l'image</a>
                                            </li>
                                            <li class = "nav-item">
                                                <a href = "{{url('/edit-password-profil')}}" class = "nav-link active" id = "payments-tab" role = "tab" aria-controls = "payments" aria-selected = "true"><i class = "mdi mdi-lock"></i> Modifier Password</a>
                                            </li>
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
                                                <h5 class = "delete-im">Si vous le souhaitez, vous pouvez supprimer votre photo de profil en cliquant sur<a href = "{{url('/delete-image')}}"> Supprimer l'image</a></b></h5>
                                            </div>
                                            <br>
                                            <form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('/update-image')}}" enctype = "multipart/form-data">
                                                @csrf    
                                                <div class = "form-group">
                                                    <label>Image de profil</label>
                                                    <input type = "file" class = "file-upload-default" name = "image" id = "image" required required accept = "image/jpeg">
                                                    <div class = "input-group col-xs-12">
                                                        <input type = "text" class = "form-control file-upload-info" disabled placeholder = "Modifier l'image de profil..">
                                                        <span class = "input-group-append">
                                                            <button class = "file-upload-browse btn btn-primary" type = "button">Modifier</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <button type = "submit" class = "btn btn-primary mr-2" id = "btn-submit">Modifier l'image de profil</button>
                                                <button type = "reset" class = "btn btn-light">Annuler</button>
                                            </form>
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
        <script src = "{{asset('js/file-upload.js')}}"></script>
    </body>
</html>