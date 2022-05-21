<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/facture.css')}}">
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
                                                        <img src = "{{asset('images/logo/favicon.png')}}" alt = "Logo de Mhamad" class = "img-fluid"/>
                                                    </div>
                                                </section>
                                                <section class = "store-user mt-5">
                                                    <div class = "col-12">
                                                        <div class = "row bb pb-3">
                                                            <div class = "col-6">
                                                                <p class = "adress"><b>Fournisseur :</b> {{$fournisseur['nom']}}</p>
                                                                <p class = "mt-2 adress"><b>Adresse :</b> {{$fournisseur['adresse']}}</p>
                                                                @if($fournisseur['tel2'] == "Aucun")
                                                                    <p class = "mt-2 adress"><b>Téléphone :</b> {{$fournisseur['tel1']}}</p>
                                                                @else
                                                                    <p class = "mt-2 adress"><b>Téléphone :</b> {{$fournisseur['tel1']}} / {{$fournisseur['tel2']}}</p>
                                                                @endif
                                                                <p class = "mt-2 adress"><b>Email :</b> {{$fournisseur['email']}}</p>
                                                                <p class = "mt-2 adress"><b>M.F. :</b> {{$fournisseur['matricule']}}</p>
                                                            </div>
                                                            <div class = "col-6">
                                                                <p class = "adress"><b>Client :</b> Mhamed Abbour</p>
                                                                <p class = "mt-2 adress"><b>Adresse :</b> Ghar El Melh</p>
                                                                <p class = "mt-2 adress"><b>Téléphone :</b> 24 513 092</p>
                                                                <p class = "mt-2 adress"><b>Email :</b> mhamedabboursingup@gmail.com</p>
                                                                <p class = "mt-2 adress"><b>M.F. :</b> 12341/W/N/E/901</p>
                                                            </div>
                                                        </div>
                                                        <div class = "row extra-info pt-3">
                                                            <div class = "col-6">
                                                                <p>Date : Du <span>{{$informationsReglemens['firstData']}}</span> Au <span>{{$informationsReglemens['lastData']}}</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section class = "product-area mt-4">
                                                    <div class = "table-responsive">
                                                        <table class = "table table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Référence du facture</th>
                                                                    <th>Désignation</th>
                                                                    <th>Quantité</th>
                                                                    <th>Prix Unitaire</th>
                                                                    <th>Remise</th>
                                                                    <th>Prix Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    $somme = 0;
                                                                ?>
                                                                @foreach($informationsFactures as $value)
                                                                    <tr>
                                                                        <td>{{$value->referenceF}}</td>
                                                                        <td>{{$value->designation}}</td>
                                                                        <td>{{$value->qte}}</td>
                                                                        <td>{{App\Http\Controllers\FactureController::stylingPrix($value->prixU)}}</td>   
                                                                        <td>0%</td>
                                                                        <td>{{App\Http\Controllers\FactureController::stylingPrix($value->prixU * $value->qte)}}</td>
                                                                    </tr>
                                                                    <?php $somme = $somme + ($value->prixU * $value->qte);?>                                                        
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </section>
                                                <section class = "balance-info">
                                                    <div class = "row">
                                                        <div class = "col-4">
                                                            <table class = "table table-bordered">
                                                                <tr>
                                                                    <td>Brut T.T.C :</td>
                                                                    <td>{{App\Http\Controllers\FactureController::stylingPrix($somme);}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Remise</td>
                                                                    <td>0%</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Total T.T.C</td>
                                                                    <td>{{App\Http\Controllers\FactureController::stylingPrix($somme);}}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </section>
                                                <div class = "col-md-12 text-center">
                                                    <button type = "button" class = "btn btn-primary me-2" id = "print" onclick = "imprimFacture()">Imprimer la facture</button>
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