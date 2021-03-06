<div>
    <div class = "col-md-12">
        <div class = "form-group">
            <div class = "input-group">
                <div class = "input-group-prepend">
                    <span class = "input-group-text" style = "color:black"><i class = "ti ti-search"></i></span>
                </div>
                <input type = "text" class = "form-control" placeholder = "Rechercher des articles par fournisseur.." wire:model = "search">
            </div>
        </div>
    </div>
    <div class = "container">
        <div class = "table-responsive">
            <table class = "table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th>Fournisseur</th>
                        <th>Date</th>
                        <th>Article</th>
                        <th>Prix d'achat</th>
                    </tr>  
                </thead>
                <tbody>
                    @if($historiques->count() == null)
                        <tr>
                            <td colspan = "4">Malheureusement, aucun historique des prix n'est enregistrĂ© dans votre application..</td>
                        </tr>
                    @else
                        @foreach($historiques as $row)
                            <tr>
                                <td class = "font-weight-bold"><div class = "badge badge-danger">{{$row->nom}}</div></td>
                                <td>{{App\Http\Controllers\FactureController::getDateAttribute($row->date)}}</td>
                                <td class = "font-weight-bold"><div class = "badge badge-warning">{{$row->designation}}</div></td>
                                <td class = "font-weight-bold"><div class = "badge badge-success">{{App\Http\Controllers\FactureController::stylingPrix($row->prixU)}}</div></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class = "container">
            {{$historiques->links('vendor.pagination.livewire_pagination')}}
        </div>
    </div>
</div>
