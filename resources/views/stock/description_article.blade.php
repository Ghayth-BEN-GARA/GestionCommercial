<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/notification.css')}}">
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
                                        <h4 class = "card-title">Stock</h4>
                                        <p class = "card-description">Consulter la description de l'article</p>
                                        <div id = "detailedReports" class = "carousel slide detailed-report-carousel position-static pt-2" data-ride = "carousel">
                                            <div class = "carousel-inner">
                                                <div class = "carousel-item active">
                                                    <div class = "row">
                                                        <div class = "col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                                            <div class = "ml-xl-4 mt-3">
                                                                <p class = "card-title">Description détaillée</p>
                                                                <h1 class = "text-primary">Article</h1>
                                                                <h3 class = "font-weight-500 mb-xl-4 text-primary">{{$descriptionArticle->designation}}</h3>
                                                                <p class = "mb-2 mb-xl-0">La description détaillée de l'article est un rapport détaillé qui aide le dirigeant de l'entreprise à gérer facilement ses activités et à optimiser les chiffres d'affaires.</p>
                                                            </div>
                                                        </div>
                                                        <div class = "col-md-12 col-xl-9">
                                                            <div class = "row">
                                                                <div class = "col-md-6 border-right">
                                                                    <div class = "table-responsive mb-3 mb-md-0 mt-3">
                                                                        <table class = "table table-borderless report-table">
                                                                            <tr>
                                                                                <td class = "text-muted">Référence</td>
                                                                                <td class = "w-100 px-0">
                                                                                    <div class = "progress progress-md mx-4">
                                                                                        <div class = "progress-bar bg-primary" role = "progressbar" style = "width: 100%" aria-valuenow = "100" aria-valuemin = "0" aria-valuemax = "100"></div>
                                                                                    </div>
                                                                                </td>
                                                                                <td><h5 class = "font-weight-bold mb-0">{{$reference}}</h5></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class = "text-muted">Désignation</td>
                                                                                <td class = "w-100 px-0">
                                                                                    <div class = "progress progress-md mx-4">
                                                                                        <div class = "progress-bar bg-warning" role = "progressbar" style = "width: 100%" aria-valuenow = "100" aria-valuemin = "0" aria-valuemax = "100"></div>
                                                                                    </div>
                                                                                </td>
                                                                                <td><h5 class = "font-weight-bold mb-0">{{$descriptionArticle->designation}}</h5></td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td class = "text-muted">Catégorie</td>
                                                                                <td class = "w-100 px-0">
                                                                                    <div class = "progress progress-md mx-4">
                                                                                        <div class = "progress-bar bg-danger" role = "progressbar" style = "width: 100%" aria-valuenow = "100" aria-valuemin = "0" aria-valuemax = "100"></div>
                                                                                    </div>
                                                                                </td>
                                                                                <td><h5 class = "font-weight-bold mb-0">{{$descriptionArticle->categorie}}</h5></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class = "text-muted">Quantité en stock</td>
                                                                                <td class = "w-100 px-0">
                                                                                    <div class = "progress progress-md mx-4">
                                                                                        <div class = "progress-bar bg-primary" role = "progressbar" style = "width: 100%" aria-valuenow = "100" aria-valuemin = "0" aria-valuemax = "100"></div>
                                                                                    </div>
                                                                                </td>
                                                                                <td><h5 class = "font-weight-bold mb-0">{{$descriptionArticle->qteStock}}</h5></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class = "text-muted">Prix d'achat actuel</td>
                                                                                <td class = "w-100 px-0">
                                                                                    <div class = "progress progress-md mx-4">
                                                                                        <div class = "progress-bar bg-danger" role = "progressbar" style = "width: 100%" aria-valuenow = "100" aria-valuemin = "0" aria-valuemax = "100"></div>
                                                                                    </div>
                                                                                </td>
                                                                                <td><h5 class = "font-weight-bold mb-0">{{App\Http\Controllers\FactureController::stylingPrix($descriptionArticle->prix)}}</h5></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class = "text-muted">Prix de vente</td>
                                                                                <td class = "w-100 px-0">
                                                                                    <div class = "progress progress-md mx-4">
                                                                                        <div class = "progress-bar bg-success" role = "progressbar" style = "width: 100%" aria-valuenow = "100" aria-valuemin = "0" aria-valuemax = "100"></div>
                                                                                    </div>
                                                                                </td>
                                                                                <td><h5 class = "font-weight-bold mb-0">{{App\Http\Controllers\FactureController::stylingPrix(App\Http\Controllers\ArticleController::calculeMargePrix($reference))}}</h5></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class = "text-muted">Marge de prix</td>
                                                                                <td class = "w-100 px-0">
                                                                                    <div class = "progress progress-md mx-4">
                                                                                        <div class = "progress-bar bg-green" role = "progressbar" style = "width: 100%" aria-valuenow = "100" aria-valuemin = "0" aria-valuemax = "100"></div>
                                                                                    </div>
                                                                                </td>
                                                                                <td><h5 class = "font-weight-bold mb-0">{{$descriptionArticle->marge}}%</h5></td>
                                                                            </tr>
                                                                        </table>
                                                                        <a href = "{{url('/historique-prix-achat?reference='.$reference)}}" class = "text-info">Voir l'historique des prix d'achat..</a>
                                                                    </div>
                                                                </div>
                                                                <div class = "col-md-6 mt-3">
                                                                    <p class = "card-title">Derniers prix des fournisseurs</p>
                                                                    <ul class = "icon-data-list">
                                                                        @foreach($other as $row)
                                                                            <li>
                                                                                <div class = "d-flex">
                                                                                    <img src = "{{asset('images/faces/user.png')}}" alt = "user">
                                                                                    <div>
                                                                                        <p class = "text-info mb-1">{{$row->nom}}</p>
                                                                                        <p class = "mb-0">{{App\Http\Controllers\FactureController::stylingPrix($row->prixU)}}</p>         
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
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
                    </div>
                    @include ('layouts.footer')
                </div>
            </div>
        </div>
        @include ('layouts.script')
    </body>
</html>