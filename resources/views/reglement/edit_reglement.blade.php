<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/pagination.css')}}">
    </head>
    <body>
        <div class = "container-scroller">
            @include ('layouts.horizontal_nav')
            <div class = "container-fluid page-body-wrapper">   
                @include ('layouts.vertical_nav')
                <div class = "main-panel">
                    <div class = "content-wrapper">
                        <div class = "row">
                            <div class = "col-md-12 grid-margin stretch-card">
                                <div class = "card">
                                    <div class = "card-body">
                                        <h4 class = "card-title">Réglements</h4>
                                        <p class = "card-description">Consulter les réglements du fournisseur</p>
                                        @if (Session::has('erreur'))
                                            <div class = "container">
                                                <div class = "alert alert-danger alert-dismissible fade show" role = "alert">
                                                    <p><strong>Désolé !</strong> {{session()->get('erreur')}}</p>
                                                    <button type = "button" class = "close" data-dismiss = "alert" aria-label = "Close">
                                                        <span aria-hidden = "true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                        @elseif (Session::has('success'))
                                            <div class = "container">
                                                <div class = "alert alert-success alert-dismissible fade show" role = "alert">
                                                    <p><strong>Trés bien !</strong> {{session()->get('success')}}</p>
                                                    <button type = "button" class = "close" data-dismiss = "alert" aria-label = "Close">
                                                        <span aria-hidden = "true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <div class = "table-responsive">
                                            <table class = "table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Référence</th>
                                                        <th>Net</th>
                                                        <th>Payé</th>
                                                        <th>Modifier le montant payé</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($listeReglements as $value)
                                                        <tr>
                                                            <td>FACTURE N° {{$value->getReferenceFAttribute()}}</td>
                                                            <td>{{App\Http\Controllers\FactureController::stylingPrix($value->net)}}</td>
                                                            <td>{{App\Http\Controllers\FactureController::stylingPrix($value->paye)}}</td>
                                                            <td>
                                                                <form class = "form-inline" name = "f" id = "f" method = "post" action = "{{url('/edit-paye-reglement')}}">
                                                                    @csrf
                                                                    <input type = "hidden" name = "ref" value = "{{$value->getReferenceFAttribute()}}">
                                                                    <label class = "sr-only" for = "inlineFormInputName2">Montant payé</label>
                                                                    <input type = "number" class = "form-control mb-2 mr-sm-2" name = "paye" placeholder = "Montant payé.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required>
                                                                    <button type = "submit" class = "btn btn-primary mb-2" id = "btn_submit1">Modifier le montant</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>       
                                            <div class = "container" id = "pg">
                                                {{$listeReglements->links('vendor.pagination.normal_pagination')}}
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    @include ('layouts.footer')
                </div>
            </div>
        </div>
        @include ('layouts.script')
    </body>
</html>