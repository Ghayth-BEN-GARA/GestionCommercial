<div>
    <div class = "col-md-12">
        <div class = "form-group">
            <div class = "input-group">
                <div class = "input-group-prepend">
                    <span class = "input-group-text" style = "color:black"><i class = "mdi mdi-account-search-outline"></i></span>
                </div>
                <input type = "text" class = "form-control" placeholder = "Rechercher des utilisateur par prénom.." wire:model = "search">
            </div>
        </div>
    </div>
    <div class = "container" id = "pg">
        <div class = "table-responsive">
            <table class = "table table-striped table-borderless">
                <thead>
                    <tr>
                        <th>Nom et prénom</th>
                        <th>CIN</th>
                        <th>Mobile</th>
                        <th colspan = "4">Actions sur l'utilisateur</th>
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
            {{$users->links('vendor.pagination.livewire_pagination')}}
        </div>
    </div>
</div>