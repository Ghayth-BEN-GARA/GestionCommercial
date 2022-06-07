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
    <div class = "container">
        <div class = "table-responsive">
            <table class = "table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th>Désignation</th>
                        <th>Référence</th>
                        <th>Catégorie</th>
                        <th>Quantité en stock</th>
                        <th>Prix d'achat</th>
                        <th>Marge de prix</th>
                        <th>Prix de vente</th>
                    </tr>  
                </thead>
                <tbody>
                    @if($stocks->count() == null)
                        <tr>
                            <td colspan = "5">Malheureusement, aucun stock n'est sauvegardé dans votre application..</td>
                        </tr>
                    @else
                        @foreach($stocks as $row)
                            <tr>
                                <td><a href = "{{url('/description-article?reference='.$row->reference)}}" class = "art-color">{{$row->designation}}</a></td>
                                <td>{{$row->reference}}</td>
                                <td>{{$row->categorie}}</td>
                                <td>{{$row->qteStock}}</td>
                                <td>{{App\Http\Controllers\FactureController::stylingPrix($row->prix)}}</td>
                                <td>{{$row->marge}}%</td>
                                <td class = "art-color" data-toggle = "modal" data-target = "#exampleModalCenter" onclick = "setDataToUpdateMarge('{{$row->reference}}')">{{App\Http\Controllers\FactureController::stylingPrix(App\Http\Controllers\ArticleController::calculeMargePrix($row->reference))}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class = "container">
            {{$stocks->links('vendor.pagination.livewire_pagination')}}
        </div>
        @extends('layouts.modal_update_marge')
    </div>
</div>