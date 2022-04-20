<div>
    <div class = "col-md-12">
        <div class = "form-group">
            <div class = "input-group">
                <div class = "input-group-prepend">
                    <span class = "input-group-text" style = "color:black"><i class = "mdi mdi-account-search-outline"></i></span>
                </div>
                <input type = "text" class = "form-control" placeholder = "Rechercher des fournisseurs.." wire:model = "search">
            </div>
        </div>
    </div>
    <div class = "container" id = "pg">
        <div class = "table-responsive">
            <table class="table table-striped table-borderless">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Matricule</th>
                        <th>Adresse e-mail</th>
                        <th colspan = "2">Actions sur les fournisseurs</th>
                    </tr>  
                </thead>
                <tbody>
                    @if($fournisseur->count() == null)
                        <tr>
                            <td colspan = "5">Malheureusement, aucun fournisseur n'a été trouvé sur votre application.</td>
                        </tr>
                    @else
                        @foreach($fournisseur as $row)
                            <tr>
                                <td>{{$row->nom}}</td>
                                <td>{{$row->matricule}}</td>
                                <td>{{$row->email}}</td>
                                <td><a href = "{{url('/fournisseur/'.$row->matricule)}}" class = "consult-user">Consulter</a></td>
                                <td><a href = "{{url('/edit-fournisseur/'.$row->matricule)}}" class = "consult-user">Modifier</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class = "container" id = "pg">
            {{$fournisseur->links('vendor.pagination.livewire_pagination')}}
        </div>
    </div>
</div>