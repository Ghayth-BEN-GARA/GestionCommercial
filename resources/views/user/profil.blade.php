<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/user.css')}}">
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
                            <div class = "col-md-12 grid-margin stretch-card user">
                                <span class = "main_bg"></span>
                                <div class = "container">
                                    <section class = "userProfile card">
                                        <div class="profile">
                                            <figure><img src = "{{$user['image']}}" alt = "Photo de profil" width = "250px" height = "250px"></figure>
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
                                            <h1 class = "name">{{$user['fullname']}}</h1>
                                            <p>{{$user['type']}} de l'application</p>
                                        </div>
                                        <div class = "rank">
                                            <h1 class = "heading">Mobile</h1>
                                            <i>(+216) {{$user['tel']}}</i>
                                        </div>
                                    </section>        
                                    <section class = "timeline_about card">   
                                        <div class = "basic_info">
                                            <h1 class = "heading">Informations personnelles</h1>
                                            <ul>
                                                <li class = "name">
                                                    <h1 class = "label">Nom et prénom :</h1>
                                                    <span class = "info">{{$user['fullname']}}</span>
                                                </li>
                                                <li class = "genre">
                                                    <h1 class = "label">Genre :</h1>
                                                    <span class = "info">{{$user['genre']}}</span>
                                                </li>
                                                <li class = "naissance">
                                                    <h1 class = "label">Date de naissance :</h1>
                                                    <span class = "info">{{$user['naissance']}}</span>
                                                </li>
                                                <li class = "cin">
                                                    <h1 class = "label">CIN :</h1>
                                                    <span class = "info">{{$user['cin']}}</span>
                                                </li>
                                                <li class = "home">
                                                    <h1 class = "label">Adresse :</h1>
                                                    <span class = "info">{{$user['adresse']}}</span>
                                                </li>
                                                <li class = "mobile">
                                                    <h1 class = "label">Numéro mobile :</h1>
                                                    <span class = "info">{{$user['tel']}}</span>
                                                </li>
                                            </ul>
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
    </body>
</html>