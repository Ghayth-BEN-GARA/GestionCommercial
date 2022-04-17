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
                <li class = "nav-item dropdown">
                    <a class = "nav-link dropdown-toggle" id = "compte" href = "javascript:void(0)" data-toggle = "dropdown">
                        <i class = "mdi mdi-account mx-0"></i>
                        <span class = "count"></span>
                    </a>
                    <div class = "dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby = "compte">
                        <p class = "mb-0 font-weight-normal float-left dropdown-header">Utilisateurs</p>
                        <a class = "dropdown-item preview-item" href = "{{url('/add-user')}}">
                            <div class = "preview-thumbnail">
                                <div class = "preview-icon bg-info">
                                    <i class = "ti-user mx-0"></i>
                                </div>
                            </div>
                            <div class = "preview-item-content">
                                <h6 class = "preview-subject font-weight-normal">Créer un nouveau utilisateur</h6>
                            </div>
                        </a>
                    </div>
                </li>
                <li class = "nav-item nav-profile dropdown">
                    <a class = "nav-link dropdown-toggle" href = "javascript:void(0)" data-toggle = "dropdown" id = "profil">
                        <img src = "images/faces/administrateur.jpg" alt = "profil"/>
                    </a>
                    <div class = "dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby = "profileDropdown">
                        <a class = "dropdown-item" onclick = "questionDeconnexion()">
                            <i class = "ti-power-off text-primary"></i>
                            Déconnexion
                        </a>
                    </div>
                <li>
            @else
            <li class = "nav-item nav-profile dropdown">
                    <a class = "nav-link dropdown-toggle" href = "javascript:void(0)" data-toggle = "dropdown" id = "profil">
                        <img src = "{{$informations['image']}}" alt = "profil"/>
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