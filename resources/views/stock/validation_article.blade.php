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
                                        <p class = "card-description">Consulter la validation des prix</p>
                                        @if (Session::has('erreur'))
                                            <div class = "alert bg-danger mb-5 py-4" role = "alert">
                                                <div class = "d-flex">
                                                    <div class = "px-3">
                                                        <p class = "phrase">{{session()->get('erreur')}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class = "card data-icon-card-primary">
                                            <div class = "card-body">
                                                <p class = "card-title text-orange">Référence de l'article</p>                      
                                                <div class = "row">
                                                    <div class = "col-8 text-gris">
                                                        <h3>{{$validations->reference}}</h3>
                                                        <p class = "text-gris font-weight-500 mb-0">Veuillez indiquer le nouvel prix de l'article <b>{{$validations->designation}}</b> et validez ce prix afin que vous aurez la meilleure gestion de vos achats.</p>
                                                        <form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('/valider-prix')}}">
                                                            @csrf
                                                            <div class = "row">
                                                                <div class = "col-md-6">
                                                                    <div class = "form-group row mt-3">
                                                                        <label class = "col-sm-6 col-form-label">Prix actuel</label>
                                                                        <div class = "col-sm-6">
                                                                            <b class = "form-control">{{App\Http\Controllers\FactureController::stylingPrix($prixActuel)}}</b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class = "col-md-6">
                                                                    <div class = "form-group row mt-3">
                                                                        <label class = "col-sm-6 col-form-label">Prix ​​suggéré</label>
                                                                        <div class = "col-sm-6">
                                                                            <b class = "form-control" id = "prix_s">{{App\Http\Controllers\FactureController::stylingPrix($validations->prix)}}</b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class = "row">
                                                                <div class = "col-md-6">
                                                                    <div class = "form-group row mt-3">
                                                                        <label class = "col-sm-6 col-form-label">Nouvel prix</label>
                                                                        <div class = "col-sm-6">
                                                                            <input type = "hidden" name = "default" id = "default" value = "{{$validations->prix}}">
                                                                            <input type = "number" class = "form-control" name = "prix" id = "prix" placeholder = "Prix.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class = "col-md-6">
                                                                    <div class = "form-group row mt-3">
                                                                        <div class = "col-sm-6">
                                                                            <input type = "hidden" name = "reference" id = "reference" value = "{{$reference}}">
                                                                            <div class = "form-check mx-sm-2">
                                                                                <label class = "form-check-label">
                                                                                    <input type = "checkbox" class = "form-check-input" name = "select" id = "select">
                                                                                    Automatique
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class = "col-md-12 text-center">
                                                                    <button type = "submit" class = "btn btn-primary" id = "btn_submit">Valider</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class = "col-4 background-icon"></div>
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
        <script>
            $('#select').on('click',function(){
                saisieAutomatiquePrix();
            });  
        </script>
    </body>
</html>