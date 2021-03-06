<div>
    <div class = "col-md-12">
        <div class = "form-group">
            <div class = "input-group">
                <div class = "input-group-prepend">
                    <span class = "input-group-text" style = "color:black"><i class = "ti ti-search"></i></span>
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
                        <th>Quantité</th>
                        <th>Prix d'achat</th>
                        <th>Prix de vente</th>
                        <th>Marge des prix</th>
                    </tr>  
                </thead>
                <tbody>
                    @if($stocks->count() == null)
                        <tr>
                            <td colspan = "5">Malheureusement, aucun stock n'est sauvegardé dans votre application..</td>
                        </tr>
                    @else
                        @foreach($stocks as $row)
                            @if($row->reference == session()->get('ref'))
                                <tr id = "{{$row->reference}}" style = "background:#ffeeb8;">
                            @else
                                <tr id = "{{$row->reference}}">
                            @endif
                                    <td><a href = "{{url('/description-article?reference='.$row->reference)}}" class = "art-color">{{$row->designation}}</a></td>
                                    <td>{{$row->reference}}</td>
                                    <td>{{$row->categorie}}</td>
                                    <td>{{$row->qteStock}}</td>
                                    <td class = "art-color" data-toggle = "modal" data-target = "#exampleModalCenter" onclick = "setDataToUpdateMarge('{{$row->reference}}')">{{App\Http\Controllers\FactureController::stylingPrix($row->prix)}}</td>
                                    <td>{{App\Http\Controllers\FactureController::stylingPrix(App\Http\Controllers\ArticleController::calculeMargePrix($row->reference))}}</td>
                                    <td class = "art-color" data-toggle = "modal" data-target = "#exampleModalCenter2" onclick = "setDataToUpdatePrix('{{$row->reference}}')">{{$row->marge}}%</td>
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
        @extends('layouts.modal_update_prix_achat')
    </div>
</div>