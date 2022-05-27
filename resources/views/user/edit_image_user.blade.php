<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/notification.css')}}">
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class = "nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id = "myTab" role = "tablist">
                                            @include ('layouts.profil_nav')
                                        </ul>
                                    </div>
                                </div>
                                <div class = "col-md-9">
                                    <div class = "osahan-account-page-right shadow-sm bg-white p-4 h-100">
                                        <div class = "tab-content" id = "myTabContent">
                                            <div class = "tab-pane fade active show" id = "payments" role = "tabpanel" aria-labelledby = "payments-tab">
                                                <h5 class = "delete-im">Si vous le souhaitez, vous pouvez supprimer votre photo de profil en cliquant sur<a href = "javascript:void(0)" onclick = "questionDeleteImage()"> Supprimer l'image</a></b></h5>
                                            </div>
                                            @if (Session::has('erreur-delete-image'))
                                                <div class = "container">
                                                    <div class = "alert bg-danger mb-5 py-4" role = "alert">
                                                        <div class = "d-flex">
                                                            <div class = "px-3">
                                                                <h5 class = "alert-heading">Photo de profil non supprimée !</h5>
                                                                <p class = "phrase">{{session()->get('erreur-delete-image')}}</p>
                                                                <a href = "#" class = "btn text-white" data-dismiss = "alert" aria-label = "Close" data-abc = "true">Fermer</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif (Session::has('success-delete-image'))
                                                <div class = "container">
                                                    <div class = "alert bg-success mb-5 py-4" role = "alert">
                                                        <div class = "d-flex">
                                                            <div class = "px-3">
                                                                <h5 class = "alert-heading">Photo de profil supprimée !</h5>
                                                                <p class = "phrase">{{session()->get('success-delete-image')}}</p>
                                                                <a href = "#" class = "btn text-white" data-dismiss = "alert" aria-label = "Close" data-abc = "true">Fermer</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif (Session::has('success-update-image'))
                                                <div class = "container">
                                                    <div class = "alert bg-success mb-5 py-4" role = "alert">
                                                        <div class = "d-flex">
                                                            <div class = "px-3">
                                                                <h5 class = "alert-heading">Photo de profil modifiée !</h5>
                                                                <p>{{session()->get('success-update-image')}}</p>
                                                                <a href = "#" class = "btn text-white" data-dismiss = "alert" aria-label = "Close" data-abc = "true">Fermer</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif (Session::has('erreur-update-image'))
                                                <div class = "container">
                                                    <div class = "alert bg-danger mb-5 py-4" role = "alert">
                                                        <div class = "d-flex">
                                                            <div class = "px-3">
                                                                <h5 class = "alert-heading">Photo de profil non modifiée !</h5>
                                                                <p>{{session()->get('erreur-update-image')}}</p>
                                                                <a href = "#" class = "btn text-white" data-dismiss = "alert" aria-label = "Close" data-abc = "true">Fermer</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <form class = "forms-sample mt-4" id = "f" name = "f" method = "post" action = "{{url('/update-image')}}" enctype = "multipart/form-data">
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
                                                <button type = "submit" class = "btn btn-primary mr-2" id = "btn_submit">Modifier l'image de profil</button>
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
        <script>
            $('#f').submit(function() {
				$('#btn_submit').prop('disabled', true);
                $("#f").submit();
         	});
        </script>
    </body>
</html>