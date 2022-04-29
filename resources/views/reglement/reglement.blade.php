<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/facture.css')}}">
        <link rel = "stylesheet" href = "{{asset('css/reglement.css')}}">
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
                            <div class = "col-md-12 grid-margin stretch-card" id = "print-fact">
                                <div class = "card">
                                    <div class = "card-body">
                                        <div class = "my-5 page">
                                            <div class = "p-5">
                                                <section class = "top-content bb d-flex justify-content-between">
                                                    <div class = "logo">
                                                        <h3 class = "nom-societe">{{$reglements['nom']}}</h3>
                                                    </div>
                                                </section>
                                                <section class = "store-user mt-5">
                                                    <div class = "col-12">
                                                        <div class = "row bb pb-3">
                                                            <div class = "col-12">
                                                                <p class = "adress text-risque"><b>Risque des clients au : </b>{{$reglements['lastData']}}</p>
                                                                <br>
                                                                <p class = "adress text-center"><b>Du </b>{{$reglements['firstData']}} <b>Au </b>{{$reglements['lastData']}}</p>
                                                                <br>
                                                                <div class = "border-div">
                                                                    <p class = "adress text-center"><b>Client : </b>{{$reglements['matricule']}} <span class = "nom-client">Mhamed Abbour</span></p>
                                                                    <p class = "adress text-center"><b>Solde : </b>{{App\Http\Controllers\FactureController::stylingPrix($reglements['solde'])}}</p>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                </section>
                                                <section class = "product-area mt-4">
                                                    <table class = "table table-hover">
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Libellé</th>
                                                            <th>Net</th>
                                                            <th>Montant payé</th>
                                                            <th>Crédit</th>
                                                        </tr>
                                                        @foreach ($listeReglements as $value)
                                                            <tr>
                                                                <td>{{$value->getDateAttribute()}}</td>
                                                                <td>FACTURE N° {{$value->getReferenceFAttribute()}} ABBOUR MHAMAD</td>
                                                                <td>{{App\Http\Controllers\FactureController::stylingPrix($value->net)}}</td>
                                                                <td>{{App\Http\Controllers\FactureController::stylingPrix($value->paye)}}</td>
                                                                <td>{{App\Http\Controllers\ReglementController::getCreditReglement($value->net,$value->paye)}}</td>
                                                            </tr>
                                                        @endforeach
                                                    <table>
                                                </section>
                                                <div class = "container" id = "pg">
                                                    {{$listeReglements->links('vendor.pagination.normal_pagination')}}
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