<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "css/pagination.css">
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
                                <div class = "card">
                                    <div class = "card-body">
                                        <h4 class = "card-title">Utilisateurs</h4>
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
                                        <p class = "card-description">Consulter les Utilisateurs</p>
                                        <div class = "table-responsive">
                                            <table class = "table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Utilisateur</th>
                                                        <th>Nom et prénom</th>
                                                        <th>CIN</th>
                                                        <th>Mobile</th>
                                                        <th colspan = "5">Actions sur l'utilisateur</th>
                                                    <tr>
                                                </thead>
                                                <tbody>
                                                    @if($users->count() == null)
                                                    <tr>
                                                        <td colspan = "5">Malheureusement, aucun utilisateur n'a été trouvé sur votre application.</td>
                                                    </tr>
                                                    @else
                                                        @foreach($users as $row)
                                                            <tr>
                                                                <td class = "py-1"><img src = "images/uploads/{{$row->getCinAttribute()}}/{{$row->photo}}" alt = "image"/></td>
                                                                <td>{{$row->prenom}} {{$row->nom}}</td>
                                                                <td>{{$row->getCinAttribute()}}</td>
                                                                <td>{{App\Http\Controllers\UserController::formatterMobile($row->tel)}}</td>
                                                                <td><a href = "{{url('/user/'.$row->getCinAttribute())}}" class = "consult-user">Consulter</a></td>
                                                                <td><a href = "javascript:void(0)" onclick = "questionSupprimerUser({{$row->getCinAttribute()}})" class = "consult-user">Supprimer</a></td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class = "container" id = "pg">
                                            {{$users->links('vendor.pagination.custom_pagination')}}
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