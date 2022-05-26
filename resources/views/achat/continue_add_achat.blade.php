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
            $('#add_item_btn').on('click', function(){
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