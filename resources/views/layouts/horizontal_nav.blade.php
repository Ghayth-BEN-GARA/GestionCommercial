<nav class = "navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class = "text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class = "navbar-brand brand-logo mr-5" href = "{{url('/home')}}"><img src = "{{asset('images/logo/favicon.png')}}" class = "mr-2" alt = "logo"/></a>
        <a class = "navbar-brand brand-logo-mini" href = "{{url('/home')}}"><img src = "{{asset('images/logo/favicon.png')}}" alt = "logo"/></a>
    </div>
    <div class = "navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class = "navbar-toggler navbar-toggler align-self-center" type = "button" data-toggle = "minimize">
            <span class = "icon-menu"></span>
        </button>
        <ul class = "navbar-nav mr-lg-2">
            <li class = "nav-item nav-search d-none d-lg-block">
                <div class = "input-group">
                    <div class = "input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class = "input-group-text" id="search">
                            <i class = "icon-search"></i>
                        </span>
                    </div>
                    <input type = "text" class = "form-control" id = "navbar-search-input" name = "navbar-search" placeholder = "Rechercher.." aria-label = "search" aria-describedby = "search" required>
                </div>
            </li>
        </ul>
        <ul class = "navbar-nav navbar-nav-right">
            @if (session('type') == 'Administrateur')
                <li class = "nav-item nav-profile dropdown">
                    <a class = "nav-link dropdown-toggle" href = "javascript:void(0)" data-toggle = "dropdown" id = "profil">
                        @if (Illuminate\Support\Facades\Route::is('user-search'))
                            <img src = "../images/faces/administrateur.jpg" alt = "profil"/>
                        @else
                            <img src = "images/faces/administrateur.jpg" alt = "profil"/>
                        @endif
                        
                    </a>
                    <div class = "dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby = "profileDropdown">
                        <a class = "dropdown-item" onclick = "questionDeconnexion()">
                            <i class = "ti-power-off text-primary"></i>
                            Déconnexion
                        </a>
                    </div>
                <li>
            @else
                @if (session('type') == 'Admin')
                    <li class = "nav-item dropdown">
                        @if(App\Http\Controllers\ValidationController::getCountValidation() == 0)
                            <a class = "nav-link count-indicator dropdown-toggle" id = "notificationDropdown" href = "#" data-toggle = "dropdown">
                                <i class = "icon-bell mx-0"></i>
                            </a>
                            <div class = "dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby = "notificationDropdown">
                                <p class = "mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                                <a class = "dropdown-item preview-item">
                                    <div class = "preview-thumbnail">
                                        <div class = "preview-icon bg-success">
                                            <i class = "ti-info-alt mx-0"></i>
                                        </div>
                                    </div>
                                    <div class = "preview-item-content">
                                        <h6 class = "preview-subject font-weight-normal">Aucun prix à vérifier </h6>
                                        <p class = "font-weight-light small-text mb-0 text-muted">
                                            Maintenant
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @else
                            <a class = "nav-link count-indicator dropdown-toggle" id = "notificationDropdown" href = "#" data-toggle = "dropdown">
                                <i class = "icon-bell mx-0"></i>
                                <span class = "count"></span>
                            </a>
                            <div class = "dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby = "notificationDropdown">
                                <p class = "mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                                @foreach(App\Http\Controllers\ValidationController::getAllValidation() as $element)
                                    <a class = "dropdown-item preview-item" href = "{{url('/validation-article?reference='.$element->reference)}}">
                                        <div class = "preview-thumbnail">
                                            <div class = "preview-icon bg-success">
                                                <i class = "ti-info-alt mx-0"></i>
                                            </div>
                                        </div>
                                        <div class = "preview-item-content">
                                            <h6 class = "preview-subject font-weight-normal">Vous devez valider l'article <b>{{$element->designation}}</b> avec le nouveau prix <b>{{App\Http\Controllers\FactureController::stylingPrix($element->getPrixAttribute())}}</b>.</h6>
                                            <p class = "font-weight-light small-text mb-0 text-muted">
                                                {{App\Http\Controllers\ValidationController::getDifferenceBetweenDates($element->getDateCreationAttribute())}}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endif
            <li class = "nav-item nav-profile dropdown">
                    <a class = "nav-link dropdown-toggle" href = "javascript:void(0)" data-toggle = "dropdown" id = "profil">
                        @if (Illuminate\Support\Facades\Route::is('user-search') || (Illuminate\Support\Facades\Route::is('fournisseur-edit')) || (Illuminate\Support\Facades\Route::is('fournisseur')) || (Illuminate\Support\Facades\Route::is('consult-achat')) || (Illuminate\Support\Facades\Route::is('consult-reglement')) || (Illuminate\Support\Facades\Route::is('reglement-edit')) || (Illuminate\Support\Facades\Route::is('reglement-facture-consult')))
                            <img src = "../{{$informations['image']}}" alt = "profil"/>
                        @else
                            <img src = "{{$informations['image']}}" alt = "profil"/>
                        @endif
                    </a>
                    <div class = "dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby = "profileDropdown">
                        <a class = "dropdown-item" href = "{{url('/profil')}}">
                            <i class = "ti-user text-primary"></i>
                            Profil
                        </a>    
                        <a class = "dropdown-item" onclick = "questionDeconnexion()">
                            <i class = "ti-power-off text-primary"></i>
                            Déconnexion
                        </a>
                    </div>
                <li>
            @endif
        </ul>
    </div>
</nav>