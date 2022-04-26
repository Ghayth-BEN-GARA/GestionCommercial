<div>
    <div class = "col-md-12">
        <div class = "form-group">
            <div class = "input-group">
                <div class = "input-group-prepend">
                    <span class = "input-group-text" style = "color:black"><i class = "mdi mdi-account-search-outline"></i></span>
                </div>
                <input type = "text" class = "form-control" placeholder = "Rechercher dans le stock.." wire:model = "search">
            </div>
        </div>
    </div>
    <div class = "container" id = "pg">
        <div class = "table-responsive">
            <table class = "table table-striped table-borderless">
                <thead>
                    <tr>
                        <th>Désignation</th>
                        <th>Référence</th>
                        <th>Catégorie</th>
                        <th>Quantité en stock</th>
                        <th>Prix</th>
                    </tr>  
                </thead>
                <tbody>
                    @if($stocks->count() == null)
                        <tr>
                            <td colspan = "5">Malheureusement, aucun stock n'a été trouvé sur votre application.</td>
                        </tr>
                    @else
                        @foreach($stocks as $row)
                            <tr>
                                <td>{{$row->designation}}</td>
                                <td>{{$row->reference}}</td>
                                <td>{{$row->categorie}}</td>
                                <td>{{$row->qteStock}}</td>
                                <td>{{$row->prix}}</td>
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