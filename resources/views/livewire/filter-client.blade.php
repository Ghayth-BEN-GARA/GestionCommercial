<div>
    <div class = "col-md-12">
        <div class = "form-group">
            <div class = "input-group">
                <div class = "input-group-prepend">
                    <span class = "input-group-text" style = "color:black"><i class = "ti ti-search"></i></span>
                </div>
                <input type = "text" class = "form-control" placeholder = "Rechercher des clients.." wire:model = "search">
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
                        <th colspan = "2">Actions</th>
                    </tr>  
                </thead>
                <tbody>
                    @if($clients->count() == null)
                        <tr>
                            <td colspan = "5">Malheureusement, aucun client n'est enregistré dans votre application..</td>
                        </tr>
                    @else
                        @foreach($clients as $row)
                            <tr>
                                <td>{{$row->getFullnameAttribute()}}</td>
                                <td>{{$row->getMatriculeAttribute()}}</td>
                                <td>{{$row->getEmailAttribute()}}</td>
                                <td><a href = "{{url('/client?matricule='.$row->getMatriculeAttribute())}}" class = "consult-user">Consulter</a></td>
                                <td><a href = "{{url('/edit-client?matricule='.$row->getMatriculeAttribute())}}" class = "consult-user">Modifier</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class = "container">
            {{$clients->links('vendor.pagination.livewire_pagination')}}
        </div>
    </div>
</div>