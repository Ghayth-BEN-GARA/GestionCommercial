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
                                                    <div class = "top-left">
                                                        <div class = "graphic-path">
                                                            <p>{{$facture['type']}}</p>
                                                        </div>
                                                        <div class = "position-relative">
                                                            <p>{{$facture['type']}} No. <span>{{$facture['referenceF']}}</span></p>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section class = "store-user mt-5">
                                                    <div class = "col-12">
                                                        <div class = "row bb pb-3">
                                                            <div class = "col-6">
                                                                <p class = "adress"><b>Fournisseur :</b> {{$facture['nom']}}</p>
                                                                <p class = "mt-2 adress"><b>Adresse :</b> {{$facture['adresse']}}</p>
                                                                @if($facture['tel2'] == "Aucun")
                                                                    <p class = "mt-2 adress"><b>Téléphone :</b> {{$facture['tel1']}}</p>
                                                                @else
                                                                    <p class = "mt-2 adress"><b>Téléphone :</b> {{$facture['tel1']}} / {{$facture['tel2']}}</p>
                                                                @endif
                                                                <p class = "mt-2 adress"><b>Email :</b> {{$facture['email']}}</p>
                                                                <p class = "mt-2 adress"><b>M.F. :</b> {{$facture['matricule']}}</p>
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
                                                            <div class = "col-7">
                                                                <p>Date : <span>{{$facture['date']}}</span></p>
                                                                <p>Heure : <span>{{$facture['heure']}}</span></p>
                                                            </div>
                                                            <div class = "col-5">
                                                                <p>Faite par : <span>{{$facture['par']}}</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section class = "product-area mt-4">
                                                    <table class = "table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Désignation</th>
                                                                <th>Quantité</th>
                                                                <th>Remise</th>
                                                                <th>Prix Unitaire</th>
                                                                <th>Prix Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $somme = 0;
                                                            ?>
                                                            @foreach($article as $value)
                                                                <tr>
                                                                    <td>{{$value->designation}}</td>
                                                                    <td>{{$value->qte}}</td>
                                                                    <td>0%</td>
                                                                    <td>{{App\Http\Controllers\FactureController::stylingPrix($value->prixU)}}</td>   
                                                                    <td>{{App\Http\Controllers\FactureController::stylingPrix($value->prixU * $value->qte)}}</td>
                                                                </tr>
                                                                <?php $somme = $somme + ($value->prixU * $value->qte);?>                                                        
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </section>
                                                <section class = "balance-info">
                                                    <div class = "row">
                                                        <div class = "col-8">
                                                            <p class = "m-0 font-weight-bold">Note :</p>
                                                                {{$facture['credit']}}
                                                        </div>
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