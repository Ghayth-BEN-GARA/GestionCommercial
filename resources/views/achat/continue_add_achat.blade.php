<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/continue.css')}}">
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
                                        <p class = "card-description">Créer une Facture</p>
                                        <form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('/add-facture-articles')}}">
                                            @csrf
                                            <fieldset class = "border p-2">
                                                <legend  class = "w-auto">Facture</legend>
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-4 col-form-label">Référence</label>
                                                            <div class = "col-sm-8">
                                                                <input type = "text" class = "form-control" name = "referenceF" id = "referenceF" onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" value = "{{$newReference}}" readonly required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class = "border p-2 mt-4"> 
                                                <legend  class = "w-auto">Articles</legend>
                                                <div class = "container">
                                                    <div class = "form-div">
                                                        <div class = "row">
                                                            <div class = "col-md-2">
                                                                Désignation
                                                            </div>
                                                            <div class = "col-md-2">
                                                                Référence
                                                            </div>
                                                            <div class = "col-md-2">
                                                                Catégorie
                                                            </div>
                                                            <div class = "col-md-2">
                                                                Quantité
                                                            </div>
                                                            <div class = "col-md-2">
                                                                Prix
                                                            </div>
                                                        </div>
                                                        <div class = "row margin-top">
                                                            <div class = "col-md-2 styleInput">
                                                                <input type = "search" class = "form-control" name = "designationAdd" id = "designationAdd" placeholder = "Désignation.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" required>
                                                            </div>
                                                            <div class = "col-md-2 styleInput">
                                                                <input type = "search" class = "form-control" name = "referenceAdd" id = "referenceAdd" placeholder = "Référence.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required>
                                                            </div>
                                                            <div class = "col-md-2 styleInput">
                                                                <input type = "search" class = "form-control" name = "categorieAdd" id = "categorieAdd" placeholder = "Catégorie.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" required>
                                                            </div>
                                                            <div class = "col-md-2">
                                                                <input type = "number" class = "form-control" name = "quantiteAdd" id = "quantiteAdd" placeholder = "Quantité.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required>
                                                            </div>
                                                            <div class = "col-md-2">
                                                                <input type = "number" class = "form-control" name = "prixAdd" id = "prixAdd" placeholder = "Prix.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required>
                                                            </div>
                                                            <div class = "col-md-2">
                                                                <button type = "button" class = "btn btn-success mr-2" name = "button_add" id = "button_add">Ajouter</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                   
                                            </fieldset>
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
            $('#button_add').on('click', function(){
                gestionAjouterLigne();
            });

            $(function(){
                searchDesignationFacture();
                searchReferenceFacture();
                searchCategorieFacture();
            });  
        </script>
    </body>
</html>