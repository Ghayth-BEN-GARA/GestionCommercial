<div>
    <div class = "col-md-12">
        <div class = "form-group">
            <div class = "input-group">
                <div class = "input-group-prepend">
                    <span class = "input-group-text" style = "color:black"><i class = "mdi mdi-account-search-outline"></i></span>
                </div>
                <input type = "text" class = "form-control" placeholder = "Rechercher des réglements.." wire:model = "search">
            </div>
        </div>
    </div>
    <div class = "container">
        <div class = "table-responsive">
            <table class = "table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Matricule</th>
                        <th>Adresse e-mail</th>
                        <th>Actions sur les fournisseurs</th>
                    </tr>  
                </thead>
                <tbody>
                    @if($reglements->count() == null)
                        <tr>
                            <td colspan = "4">Malheureusement, aucun réglement n'est enregistré dans votre application..</td>
                        </tr>
                    @else
                        @foreach($reglements as $row)
                            <tr>
                                <td>{{$row->nom}}</td>
                                <td>{{$row->matricule}}</td>
                                <td>{{$row->email}}</td>
                                <td><a href = "{{url('/reglement/'.$row->matricule)}}" class = "consult-user">Consulter</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class = "container">
            {{$reglements->links('vendor.pagination.livewire_pagination')}}
        </div>
    </div>
</div>