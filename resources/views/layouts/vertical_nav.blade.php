<nav class = "sidebar sidebar-offcanvas" id = "sidebar">
    <ul class = "nav">
        <li class = "nav-item">
            <a class = "nav-link" href = "{{url('/home')}}">
                <i class = "mdi mdi-home menu-icon"></i>
                <span class = "menu-title">Accueil</span>
            </a>
        </li>
        @if (session('type') == 'Admin')
            <li class = "nav-item">
                <a class = "nav-link" href = "{{url('/profil')}}">
                    <i class = "mdi mdi-account menu-icon"></i>
                    <span class = "menu-title">Profil</span>
                </a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" data-toggle = "collapse" href = "#user" aria-expanded = "false" aria-controls = "user">
                    <i class = "mdi mdi-account-search menu-icon"></i>
                    <span class = "menu-title">Utilisateurs</span>
                    <i class = "menu-arrow"></i>
                </a>
                <div class = "collapse" id = "user">
                    <ul class = "nav flex-column sub-menu">
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('/add-user')}}">Ajouter des utilisateurs</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('/list-user')}}">Consulter des utilisateurs</a></li>
                    </ul>
                </div>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" data-toggle = "collapse" href = "#achat" aria-expanded = "false" aria-controls = "achat">
                    <i class = "mdi mdi-more menu-icon"></i>
                    <span class = "menu-title">Achat</span>
                    <i class = "menu-arrow"></i>
                </a>
                <div class = "collapse" id = "achat">
                    <ul class = "nav flex-column sub-menu">
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('/add-achat')}}">Ajouter des achats</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('/list-achat')}}">Consulter les achats</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('/add-fournisseur')}}">Ajouter des fournisseurs</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('/list-fournisseur')}}">Consulter les fournisseurs</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('/list-reglement')}}">Consulter les réglements</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('/others')}}">Avancée</a></li>
                    </ul>
                </div>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" data-toggle = "collapse" href = "#vente" aria-expanded = "false" aria-controls = "vente">
                    <i class = "mdi mdi-sale menu-icon"></i>
                    <span class = "menu-title">Vente</span>
                    <i class = "menu-arrow"></i>
                </a>
                <div class = "collapse" id = "vente">
                    <ul class = "nav flex-column sub-menu">
                        <li class = "nav-item"><a class = "nav-link" href = "#">Caisse</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "#">Consulter les ventes</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('/add-client')}}">Ajouter des clients</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('/list-clients')}}">Consulter les clients</a></li>
                    </ul>
                </div>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" data-toggle = "collapse" href = "#stock" aria-expanded = "false" aria-controls = "stock">
                    <i class = "mdi mdi-stocking menu-icon"></i>
                    <span class = "menu-title">Stock</span>
                    <i class = "menu-arrow"></i>
                </a>
                <div class = "collapse" id = "stock">
                    <ul class = "nav flex-column sub-menu">
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('/list-stock')}}">Consulter le stock</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('/article-disponible')}}">Disponibilité</a></li>
                    </ul>
                </div>
            </li>
            @elseif (session('type') == 'User')
            <li class = "nav-item">
                <a class = "nav-link" href = "{{url('/profil')}}">
                    <i class = "mdi mdi-account menu-icon"></i>
                    <span class = "menu-title">Profil</span>
                </a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" data-toggle = "collapse" href = "#vente" aria-expanded = "false" aria-controls = "vente">
                    <i class = "mdi mdi-sale menu-icon"></i>
                    <span class = "menu-title">Vente</span>
                    <i class = "menu-arrow"></i>
                </a>
                <div class = "collapse" id = "vente">
                    <ul class = "nav flex-column sub-menu">
                        <li class = "nav-item"><a class = "nav-link" href = "#">Caisse</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "#">Consulter les ventes</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "#">Ajouter des clients</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "#">Consulter les clients</a></li>
                    </ul>
                </div>
            </li>
        @elseif(session('type') == 'Administrateur')
            <li class = "nav-item">
                <a class = "nav-link" data-toggle = "collapse" href = "#user" aria-expanded = "false" aria-controls = "user">
                    <i class = "mdi mdi-account-search menu-icon"></i>
                    <span class = "menu-title">Utilisateurs</span>
                    <i class = "menu-arrow"></i>
                </a>
                <div class = "collapse" id = "user">
                    <ul class = "nav flex-column sub-menu">
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('add-user')}}">Ajouter des utilisateurs</a></li>
                        <li class = "nav-item"><a class = "nav-link" href = "{{url('list-user')}}">Consulter des utilisateurs</a></li>
                    </ul>
                </div>
            </li>
        @endif
    </ul>
</nav>