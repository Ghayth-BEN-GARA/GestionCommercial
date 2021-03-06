<div>
    <div class = "col-md-12">
        <div class = "form-group">
            <div class = "input-group">
                <div class = "input-group-prepend">
                    <span class = "input-group-text" style = "color:black"><i class = "ti ti-search"></i></span>
                </div>
                <input type = "text" class = "form-control" placeholder = "Rechercher des utilisateur.." wire:model = "search">
            </div>
        </div>
    </div>
    <div class = "container">
        <div class = "table-responsive">
            <table class = "table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Nom et prénom</th>
                        <th>CIN</th>
                        <th>Mobile</th>
                        <th colspan = "4">Actions</th>
                    <tr>
                </thead>
                <tbody>
                    @if($users->count() == null)
                    <tr>
                        <td colspan = "6">Malheureusement, aucun utilisateur n'est enregistré avec ces informations dans votre application..</td>
                    </tr>
                    @else
                        @foreach($users as $row)
                            <tr>
                                <td><img src = "images/uploads/{{$row->cin}}/{{$row->photo}}" alt = "image"></td>
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
        <div class = "container">
            {{$users->links('vendor.pagination.livewire_pagination')}}
        </div>
    </div>
</div>