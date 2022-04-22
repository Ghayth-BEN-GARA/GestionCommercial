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
                                        <h4 class = "card-title">Facture</h4>
                                        @if (Session::has('erreur'))
                                            <div class = "container">
                                                <div class = "alert alert-danger alert-dismissible fade show" role = "alert">
                                                    <p><strong>Désolé !</strong> {{session()->get('erreur')}}</p>
                                                    <button type = "button" class = "close" data-dismiss = "alert" aria-label = "Close">
                                                        <span aria-hidden = "true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <p class = "card-description">Créer une Facture</p>
                                        <div class = "form-group row">
                                            <label for = "exampleInputUsername2" class = "col-sm-3 col-form-label">Référence du facture</label>
                                            <div class = "col-sm-9" class = "styleInput">
                                                @if($reference != null)
                                                    <input type = "text" class = "form-control" id = "referenceF" name = "referenceF" placeholder = "Saisissez la référence du facture.." onkeypress = "return event.charCode>=48 && event.charCode<=57" value = "{{$reference}}" required>
                                                    @else
                                                    <input type = "text" class = "form-control" id = "referenceF" name = "referenceF" placeholder = "Saisissez la référence du facture.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required>
                                                @endif
                                            </div>
                                        </div>
                                        <div class = "container">
                                        <form class = "forms-sample" id = "f" name = "f" method = "post" action = "#">
                                            @csrf
                                            <table class = "table table-striped table-borderless" id = "article">
                                                <thead>
                                                    <tr>
                                                        <th>Désignation</th>
                                                        <th>Référence</th>
                                                        <th>Catégorie</th>
                                                        <th>Quantité
                                                        <th>Prix unitaire</th>
                                                        <th>Prix totale</th>
                                                        <th>Action</th>
                                                    </tr>  
                                                </thead>
                                                <tbody>
                                                    <tr class = "styleInput" id = "row0">
                                                        <td class = "styleInput"><input type = "text" class = "form-control" name = "designation[]" id = "designation0" placeholder = "Désignation.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" required></td>
                                                        <td class = "styleInput"><input type = "text" class = "form-control" name = "reference[]" id = "reference0" placeholder = "Référence.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required></td>
                                                        <td class = "styleInput"><input type = "text" class = "form-control" name = "categorie[]" id = "categorie0" placeholder = "Catégorie.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" required></td>
                                                        <td><input type = "number" class = "form-control" name = "quantite[]" id = "quantite0" placeholder = "Quantité.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required></td>
                                                        <td><input type = "number" class = "form-control" name = "prix[]" id = "prix0" placeholder = "Prix.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required></td>
                                                        <td class = "table-warning"><span id = "prixT0" name = "prixT[]">0 DT</span></td>
                                                        <td><button class = "btn btn-success mr-2" id = "add_item_btn" type = "button">Ajouter</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                            <button type = "submit" class = "btn btn-primary mr-2 float-right" id = "btn-submit">Créer une facture</button>
                                        </form>
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
        <script src = "{{asset('vendors/typeahead.js/bootstrap3-typeahead.min.js')}}"></script>
        <script>
            var compteur = 0;
            $(function(){
                searchReferenceFacture();
                searchDesignationFacture(compteur);
                searchReferenceFacture(compteur);
                searchCategorieFacture(compteur);
                functionCalculerPrixTotale(compteur);
                functionCliqueAjouterLigne();  
                functionCliqueSupprimerLigne();   
            });        
        </script>
    </body>
</html>