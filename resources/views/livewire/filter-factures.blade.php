<div>
    <div class = "col-md-12">
        <div class = "form-group">
            <div class = "input-group">
                <div class = "input-group-prepend">
                    <span class = "input-group-text" style = "color:black"><i class = "ti ti-search"></i></span>
                </div>
                <input type = "text" class = "form-control" placeholder = "Rechercher des achats.." wire:model = "search">
            </div>
        </div>
    </div>
    <div class = "container">
        <div class = "table-responsive">
            <table class = "table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Fournisseur</th>
                        <th>Date et heure</th>
                        <th>Type</th>
                        <th colspan = "2">Actions</th>
                    </tr>  
                </thead>
                <tbody>
                    @if($factures->count() == null)
                        <tr>
                            <td colspan = "5">Malheureusement, aucune facture n'est trouvée dans votre application..</td>
                        </tr>
                    @else
                        @foreach($factures as $row)
                            <tr>
                                <td>{{$row->referenceF}}</td>
                                <td>{{$row->nom}}</td>
                                <td>{{$row->date}} à {{$row->heure}}</td>
                                <td>{{$row->type}}</td>
                                <td><a href = "{{url('/facture?reference='.$row->referenceF)}}" class = "consult-user">Consulter</a></td>
                                <td><a href = "#" onclick = "questionSupprimerFacture('{{$row->referenceF}}')" class = "consult-user">Supprimer</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class = "container">
            {{$factures->links('vendor.pagination.livewire_pagination')}}
        </div>
    </div>
</div>