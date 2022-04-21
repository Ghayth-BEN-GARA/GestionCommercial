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
                                        <form class = "forms-sample" id = "f" name = "f" method = "post" action = "#">
                                            @csrf
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
            $(function(){
                searchReferenceFacture();
            });
        </script>
    </body>
</html>