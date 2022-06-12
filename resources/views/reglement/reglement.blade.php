<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/pagination.css')}}">
        <link rel = "stylesheet" href = "{{asset('css/reglement.css')}}">
    </head>
    <body>
        <div class = "container-scroller">
            @include ('layouts.horizontal_nav')
            <div class = "container-fluid page-body-wrapper">   
                @include ('layouts.vertical_nav')
                <div class = "main-panel">
                    <div class = "content-wrapper">
                        <div class = "row">
                            <div class = "col-md-12 grid-margin stretch-card" id = "print-reglement">
                                <div class = "card">
                                    <div class = "card-body">
                                        <h4 class = "card-title" id = "tit">Réglements</h4>
                                        <p class = "card-description" id = "desc">Consulter le réglements des fournisseurs</p>
                                        <div class = "container">
                                            <div class = "row">
                                                <div class = "col-md-12">
                                                    <div class = "row">
                                                        <div class = "col-md-5 col-sm-6">
                                                            <div class = "p-4 d-flex flex-column purple-bg-color round-corner">
                                                                <span class = "text-uppercase font-10 weight-600 white-color-2">Solde des réglements</span>
                                                                <span class = "font-28 weight-700 white-color mt-4">{{App\Http\Controllers\FactureController::stylingPrix($reglements['solde'])}}</span>
                                                                <span class = "font-12 weight-300 white-color-2">Au {{$reglements['lastData']}}</span>
                                                                <div class = "d-flex flex-row justify-content-between mt-4">
                                                                    <div class = "d-flex flex-column">
                                                                        <span class = "font-16 weight-600 white-color">{{$reglements['firstData']}}</span>
                                                                        <span class = "font-12 weight-300 white-color-2">Début</span>
                                                                    </div>
                                                                    <div class = "d-flex flex-column">
                                                                        <span class = "font-16 weight-600 white-color">{{$reglements['lastData']}}</span>
                                                                        <span class = "font-12 weight-300 white-color-2">Fin</span>
                                                                    </div>
                                                                </div>
                                                                <div class = "d-flex flex-row mt-4">
                                                                    <button type = "button" class = "flex-grow-1 me-1 py-2 text-uppercase font-12 weight-700 purple-color-2 grey-bg-color" onclick = "ouvrirRoot('/add-reglement-libre?matricule={{$matricule}}')">Ajouter</button>
                                                                    <button type = "button" class = "flex-grow-1 ms-1 py-2 text-uppercase font-12 weight-700 white-color-2 orange-bg-color margin-left-1" onclick = "ouvrirRootEditReglement('{{$matricule}}')">Modifier</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class = "col-md-7 col-sm-6" id = "infos">
                                                            <div class = "p-4 d-flex flex-column light-yellow-bg-color round-corner">
                                                                <div class = "table-responsive">
                                                                    <table class = "table table-borderless">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class = "text-uppercase font-10 weight-600"><a href = "{{url('/fournisseur?matricule='.$reglements['matricule'])}}" class = "grey-color-2 info-href">Informations du fournisseur</a></th>
                                                                                <th class = "text-end text-uppercase font-10 weight-600 purple-color-2"><a href = "{{url('/facture-reglement?matricule='.$reglements['matricule'])}}" class = "grey-color-2 info-href">Voir les factures</a></th>  
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class = "d-flex flex-row">
                                                                                        <div class = "d-flex flex-row justify-content-center align-items-center square round-corner-small font-20 light-orange-bg-color orange-color">
                                                                                            <i class = "mdi mdi-account-circle"></i>
                                                                                        </div>
                                                                                        <div class = "d-flex flex-column ps-2 align-items-center">
                                                                                            <span class = "font-14 weight-700 purple-color-2">Nom</span>
                                                                                            <span class = "font-10 weight-400 purple-color-2 mt-1">{{$reglements['nom']}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class = "d-flex flex-row">
                                                                                        <div class = "d-flex flex-row justify-content-center align-items-center square round-corner-small font-20 light-orange-bg-color orange-color">
                                                                                            <i class = "mdi mdi-matrix"></i>
                                                                                        </div>
                                                                                        <div class = "d-flex flex-column ps-2 align-items-center">
                                                                                            <span class = "font-14 weight-700 purple-color-2">Matricule</span>
                                                                                            <span class = "font-10 weight-400 purple-color-2 mt-1">{{$reglements['matricule']}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class = "d-flex flex-row">
                                                                                        <div class = "d-flex flex-row justify-content-center align-items-center square round-corner-small font-20 light-orange-bg-color orange-color">
                                                                                            <i class = "mdi mdi-cellphone"></i>
                                                                                        </div>
                                                                                        <div class = "d-flex flex-column ps-2 align-items-center">
                                                                                            <span class = "font-14 weight-700 purple-color-2">Mobile</span>
                                                                                            <span class = "font-10 weight-400 purple-color-2 mt-1">{{$fournisseur['tel1']}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class = "d-flex flex-row">
                                                                                        <div class = "d-flex flex-row justify-content-center align-items-center square round-corner-small font-20 light-orange-bg-color orange-color">
                                                                                            <i class = "mdi mdi-cellphone"></i>
                                                                                        </div>
                                                                                        <div class = "d-flex flex-column ps-2 align-items-center">
                                                                                            <span class = "font-14 weight-700 purple-color-2">Mobile</span>
                                                                                            <span class = "font-10 weight-400 purple-color-2 mt-1">{{$fournisseur['tel2']}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class = "col-md-12 grid-margin transparent mt-4">
                                                        <div class = "row">
                                                            <div class = "col-md-4 mb-4 stretch-card transparent">
                                                                <div class = "card card-tale">
                                                                    <div class = "card-body">
                                                                        <p class = "mb-4">Totale net</p>
                                                                        <p class = "fs-30 mb-2">{{App\Http\Controllers\FactureController::stylingPrix($reglements['solde'])}}</p>
                                                                        <p>{{$reglements['lastData']}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class = "col-md-4 mb-4 stretch-card transparent">
                                                                <div class = "card card-dark-blue">
                                                                    <div class = "card-body">
                                                                        <p class = "mb-4">Totale payé</p>
                                                                        <p class = "fs-30 mb-2">{{App\Http\Controllers\FactureController::stylingPrix($montantReglement)}}</p>
                                                                        <p>{{$reglements['lastData']}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class = "col-md-4 mb-4 stretch-card transparent">
                                                                <div class = "card card-light-blue">
                                                                    <div class = "card-body">
                                                                        <p class = "mb-4">Crédit du réglement</p>
                                                                        <p class = "fs-30 mb-2">{{App\Http\Controllers\FactureController::stylingPrix($soldeCredit)}}</p>
                                                                        <p>{{$reglements['lastData']}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class = "row">
                                                        <div class = "table-responsive">
                                                            <table class = "table table-borderless table-striped table-hover">
                                                                <caption id = "caption" class = "mt-2 text-center" style = "font-weight:bolder; text-transform:uppercase; 2px 2px #ff0000;"><b class = "text-danger" style = "font-size:40px">.</b> Réglement libre | <b class = "text-warning" style = "font-size:40px">.</b> Réglement intégré</caption>
                                                                <thead>
                                                                    <tr>
                                                                        <th>Date</th>
                                                                        <th>Libellé</th>
                                                                        <th>Net</th>
                                                                        <th>Payé</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($listeReglements as $value)
                                                                        @if($value->net != 0)
                                                                            <tr class = "table-warning">
                                                                        @else
                                                                            <tr class = "table-danger">
                                                                        @endif
                                                                                <td>{{$value->getDateAttribute()}}</td>
                                                                                <td>FACTURE N° {{$value->getReferenceFAttribute()}}</td>
                                                                                <td>{{App\Http\Controllers\FactureController::stylingPrix($value->net)}}</td>
                                                                                <td>{{App\Http\Controllers\FactureController::stylingPrix($value->paye)}}</td>
                                                                            </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table> 
                                                            <div class = "col-md-12 text-center mt-3">
                                                                <button type = "button" class = "btn btn-primary me-2 btn-icon-text" id = "print" onclick = "imprimFacture()"><i class = "ti-printer btn-icon-append"></i>  Imprimer le réglement</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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