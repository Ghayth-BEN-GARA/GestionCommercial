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
                                                        <p class = "mb-0 text-black font-weight-bold"><a class = "text-primary mr-3" data-toggle = "modal" data-target = "#edit-profile-modal" href = "#"><i class = "mdi mdi-account-edit"></i> MODIFIER</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class = "nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id = "myTab" role = "tablist">
                                            <li class = "nav-item">
                                                <a href = "{{url('/edit-image-profil')}}" class = "nav-link active" id = "payments-tab" role = "tab" aria-controls = "payments" aria-selected = "true"><i class = "mdi mdi-file-image"></i> Modifier l'image</a>
                                            </li>
                                            <li class = "nav-item">
                                                <a class = "nav-link active" id = "payments-tab" data-toggle = "tab" href = "#" role = "tab" aria-controls = "payments" aria-selected = "true"><i class = "mdi mdi-lock"></i> Modifier Password</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class = "col-md-9">
                                    <div class = "osahan-account-page-right shadow-sm bg-white p-4 h-100">
                                        <div class = "tab-content" id = "myTabContent">
                                            <div class = "tab-pane fade active show" id = "payments" role = "tabpanel" aria-labelledby = "payments-tab">
                                                <h4 class = "font-weight-bold mt-0 mb-4" style = "text-align:center">Informations</h4>
                                                <div class = "row margin">
                                                    <div class = "col-md-6">
                                                        <div class = "bg-white card payments-item mb-4 shadow-sm">
                                                            <div class = "gold-members p-4">
                                                                <a href = "#"></a>
                                                                <div class = "media">
                                                                    <div class = "media-body">
                                                                        <a href = "#"><h6 class = "mb-1"><i class = "mdi mdi-account mdi-4x"></i> Nom du personne</h6>
                                                                            <p>{{$informations['nom']}}</p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div class = "col-md-6">
                                                        <div class = "bg-white card payments-item mb-4 shadow-sm">
                                                            <div class = "gold-members p-4">
                                                                <a href = "#"></a>
                                                                <div class = "media">
                                                                    <div class = "media-body">
                                                                        <a href = "#"><h6 class = "mb-1"><i class = "mdi mdi-account mdi-4x"></i> Prénom du personne</h6>
                                                                            <p>{{$informations['prenom']}}</p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                </div>
                                                <div class = "row margin">
                                                    <div class = "col-md-6">
                                                        <div class = "bg-white card payments-item mb-4 shadow-sm">
                                                            <div class = "gold-members p-4">
                                                                <a href = "#"></a>
                                                                <div class = "media">
                                                                    <div class = "media-body">
                                                                        <a href = "#"><h6 class = "mb-1"><i class = "mdi mdi-gender-male-female mdi-4x"></i> Genre du personne</h6>
                                                                            <p>{{$informations['genre']}}</p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div class = "col-md-6">
                                                        <div class = "bg-white card payments-item mb-4 shadow-sm">
                                                            <div class = "gold-members p-4">
                                                                <a href = "#"></a>
                                                                <div class = "media">
                                                                    <div class = "media-body">
                                                                        <a href = "#"><h6 class = "mb-1"><i class = "mdi mdi-calendar mdi-4x"></i> Naissance du personne</h6>
                                                                            <p>{{$informations['naissance']}}</p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                </div>
                                                <div class = "row margin">
                                                    <div class = "col-md-6">
                                                        <div class = "bg-white card payments-item mb-4 shadow-sm">
                                                            <div class = "gold-members p-4">
                                                                <a href = "#"></a>
                                                                <div class = "media">
                                                                    <div class = "media-body">
                                                                        <a href = "#"><h6 class = "mb-1"><i class = "mdi mdi-cellphone mdi-4x"></i> Numéro du personne</h6>
                                                                            <p>{{$informations['tel']}}</p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div class = "col-md-6">
                                                        <div class = "bg-white card payments-item mb-4 shadow-sm">
                                                            <div class = "gold-members p-4">
                                                                <a href = "#"></a>
                                                                <div class = "media">
                                                                    <div class = "media-body">
                                                                        <a href = "#"><h6 class = "mb-1"><i class = "mdi mdi-home mdi-4x"></i> Adresse du personne</h6>
                                                                            <p>{{$informations['adresse']}}</p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                </div>
                                                <div class = "row margin">
                                                    <div class = "col-md-6">
                                                        <div class = "bg-white card payments-item mb-4 shadow-sm">
                                                            <div class = "gold-members p-4">
                                                                <a href = "#"></a>
                                                                <div class = "media">
                                                                    <div class = "media-body">
                                                                        <a href = "#"><h6 class = "mb-1"><i class = "mdi mdi-account-box mdi-4x"></i> CIN du personne</h6>
                                                                            <p>{{$informations['cin']}}</p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div class = "col-md-6">
                                                        <div class = "bg-white card payments-item mb-4 shadow-sm">
                                                            <div class = "gold-members p-4">
                                                                <a href = "#"></a>
                                                                <div class = "media">
                                                                    <div class = "media-body">
                                                                        <a href = "#"><h6 class = "mb-1"><i class = "mdi mdi-check-network mdi-4x"></i> Type du personne</h6>
                                                                            <p>{{$informations['type']}}</p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                </div>
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
    </body>
</html>