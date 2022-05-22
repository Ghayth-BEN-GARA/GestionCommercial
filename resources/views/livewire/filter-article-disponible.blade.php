<div>
    <div class = "col-md-12">
        <div class = "form-group">
            <div class = "input-group">
                <div class = "input-group-prepend">
                    <span class = "input-group-text" style = "color:black"><i class = "mdi mdi-search-web"></i></span>
                </div>
                <input type = "text" class = "form-control" placeholder = "Rechercher dans le stock.." wire:model = "search">
            </div>
        </div>
    </div>
    <div class = "container" id = "pg">
        <div class = "table-responsive">
            <table class = "table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th>Désignation</th>
                        <th>Référence</th>
                        <th>Catégorie</th>
                        <th>Etat</th>
                    </tr>  
                </thead>
                <tbody>
                    @if($stocks->count() == null)
                        <tr>
                            <td colspan = "5">Malheureusement, aucune artice n'est enregistrée avec ces informations dans votre application..</td>
                        </tr>
                    @else
                        @foreach($stocks as $row)
                            <tr>
                                <td>{{$row->designation}}</td>
                                <td>{{$row->reference}}</td>
                                <td>{{$row->categorie}}</td>
                                @if($row->qteStock == 0)
                                    <td><label class = "badge badge-danger">Indisponible</label></td>
                                @else
                                    <td><label class = "badge badge-success">Disponible</label></td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class = "container" id = "pg">
            {{$stocks->links('vendor.pagination.livewire_pagination')}}
        </div>
    </div>
</div>