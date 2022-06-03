<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/nice-select.css')}}">
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
                                        <h4 class = "card-title">Achat</h4>
                                        @if (Session::has('erreur'))
                                            <div class = "alert bg-danger mb-5 py-4" role = "alert">
                                                <div class = "d-flex">
                                                    <div class = "px-3">
                                                        <p class = "phrase">{{session()->get('erreur')}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif (Session::has('success'))
                                            <div class = "alert bg-success mb-5 py-4" role = "alert">
                                                <div class = "d-flex">
                                                    <div class = "px-3">
                                                        <p class = "phrase2">{{session()->get('success')}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <p class = "card-description">Créer une catégorie</p>
                                        <form class = "form-inline" name = "f1" id = "f1" method = "post" action = "{{url('/add-categorie')}}">
                                            @csrf
                                            <label class = "sr-only" for = "inlineFormInputName2">Catégorie</label>
                                            <input type = "text" class = "form-control mb-2 mr-sm-2" id = "nom" name = "nom" placeholder = "Saisissez la catégorie.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" required>
                                            <button type = "submit" class = "btn btn-primary mb-2" id = "btn_submit1">Créer une catégorie</button>
                                        </form>
                                        <br>
                                        <p class = "card-description">Créer un article</p>
                                        <form class = "form-inline" name = "f2" id = "f2" method = "get" action = "{{url('/add-article')}}">
                                            <label class = "sr-only" for = "inlineFormInputName2">Référence</label>    
                                            <input type = "number" class = "form-control mb-2 mr-sm-2" id = "reference" name = "reference" placeholder = "Saisissez la référence.." onKeyPress = "return event.charCode>=48 && event.charCode<=57" required>
                                            <label class = "sr-only" for = "inlineFormInputName2">Désignation</label> 
                                            <input type = "text" class = "form-control mb-2 mr-sm-2" id = "designation" name = "designation" placeholder = "Saisissez la désignation.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" required>
                                            <label class = "sr-only" for = "inlineFormInputName2" >Catégorie</label>
                                            <select id = "categorie" name = "categorie" class = "nice-select mb-2 mr-sm-2 col-md-2" required>
                                                <option value = "Catégorie" selected disabled>Catégorie</option>
                                                @if($categories->count() == null)
                                                    <option value = "Aucun" selected disabled>Pas de catégorie disponible pour le moment !</option>
                                                @else
                                                    @foreach($categories as $row)
                                                        <option value = "{{$row->nom}}">{{$row->nom}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <button type = "submit" class = "btn btn-primary mb-2" id = "btn_submit2">Créer un article</button>
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
        <script src = "{{asset('js/jquery.nice-select.js')}}"></script>
        <script>
            $(function(){ 
                configSelect($('#categorie'));
            });

            $('#f1').submit(function() {
				$('#btn_submit1').prop('disabled', true);
                $("#f1").submit();
         	});

            $('#f2').submit(function() {
				validerFormulaireAddArticle();
         	});
        </script>
    </body>
</html>