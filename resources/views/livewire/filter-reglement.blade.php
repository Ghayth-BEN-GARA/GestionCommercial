<div>
    <div class = "col-md-12">
        <div class = "form-group">
            <div class = "input-group">
                <div class = "input-group-prepend">
                    <span class = "input-group-text" style = "color:black"><i class = "ti ti-search"></i></span>
                </div>
                <input type = "text" class = "form-control" placeholder = "Rechercher des réglements.." wire:model = "search">
            </div>
        </div>
    </div>
    <div class = "container">
        <div class = "table-responsive">
            <table class = "table table-borderless table-striped table-hover">
                <caption id = "caption" class = "mt-2 text-center" style = "font-weight:bolder; text-transform:uppercase; 2px 2px #ff0000;"><b class = "text-danger" style = "font-size:40px">.</b> Crédit de fournisseur | <b class = "text-warning" style = "font-size:40px">.</b> Crédit de société | <b style = "color:#EAEAF1;font-size:40px">.</b> Pas de crédit</caption>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Matricule</th>
                        <th>Adresse e-mail</th>
                        <th>Crédit</th>
                        <th>Actions</th>
                    </tr>  
                </thead>
                <tbody>
                    @if($reglements->count() == null)
                        <tr>
                            <td colspan = "4">Malheureusement, aucun réglement n'est enregistré dans votre application..</td>
                        </tr>
                    @else
                        @foreach($reglements as $row)
                            @if(App\Http\Controllers\ReglementController::getCreditReglementListeFournisseur($row->matricule) > 0)
                                <tr class = "table-warning">
                            @elseif(App\Http\Controllers\ReglementController::getCreditReglementListeFournisseur($row->matricule) < 0)
                                <tr class = "table-danger">
                            @endif
                                <td>{{$row->nom}}</td>
                                <td>{{$row->matricule}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{App\Http\Controllers\FactureController::stylingPrix(App\Http\Controllers\ReglementController::getCreditReglementListeFournisseur($row->matricule))}}</td>
                                <td><a href = "{{url('/reglement?matricule='.$row->matricule)}}" class = "consult-user">Consulter</a></td>
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