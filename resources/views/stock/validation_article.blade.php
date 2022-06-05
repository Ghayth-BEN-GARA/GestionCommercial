<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
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
                                        <div class = "card data-icon-card-primary">
                                            <div class = "card-body">
                                                <p class = "card-title text-white">Référence de l'article</p>                      
                                                <div class = "row">
                                                    <div class = "col-8 text-white">
                                                        <h3>{{$validations->reference}}</h3>
                                                        <p class = "text-white font-weight-500 mb-0">Veuillez indiquer le nouveau prix de l'article <b>{{$validations->designation}}</b> et validez ce prix afin que vous aurez la meilleure gestion de vos achats.</p>
                                                        <form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('valider-prix')}}">
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
                                                                            <b class = "form-control">{{App\Http\Controllers\FactureController::stylingPrix($validations->prix)}}</b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class = "row">
                                                                <div class = "col-md-6">
                                                                    <div class = "form-group row mt-3">
                                                                        <label class = "col-sm-6 col-form-label">Nouveau prix</label>
                                                                        <div class = "col-sm-6">
                                                                            <input type = "number" class = "form-control" name = "prix" id = "prix" placeholder = "Prix.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class = "col-md-6">
                                                                    <div class = "form-group row mt-3">
                                                                        <div class = "col-sm-6">
                                                                            <button type = "submit" class = "btn btn-primary" id = "btn_submit">Valider</button>
                                                                        </div>
                                                                    </div>
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
    </body>
</html>