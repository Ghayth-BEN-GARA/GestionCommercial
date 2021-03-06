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
                                        <p class = "card-description">Cr??er une cat??gorie</p>
                                        <form class = "form-inline" name = "f1" id = "f1" method = "post" action = "{{url('/add-categorie')}}">
                                            @csrf
                                            <label class = "sr-only" for = "inlineFormInputName2">Cat??gorie</label>
                                            <input type = "text" class = "form-control mb-2 mr-sm-2" id = "nom" name = "nom" placeholder = "Saisissez la cat??gorie.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" required>
                                            <button type = "submit" class = "btn btn-primary mb-2" id = "btn_submit1">Cr??er une cat??gorie</button>
                                        </form>
                                        <br>
                                        <p class = "card-description">Cr??er un article</p>
                                        <form class = "form-inline" name = "f2" id = "f2" method = "get" action = "{{url('/add-article')}}">
                                            <label class = "sr-only" for = "inlineFormInputName2">R??f??rence</label>    
                                            <input type = "number" class = "form-control mb-2 mr-sm-2" id = "reference" name = "reference" placeholder = "Saisissez la r??f??rence.." onKeyPress = "return (event.charCode>=48 && event.charCode<=57)" required>
                                            <label class = "sr-only" for = "inlineFormInputName2">D??signation</label> 
                                            <input type = "text" class = "form-control mb-2 mr-sm-2" id = "designation" name = "designation" placeholder = "Saisissez la d??signation.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32) || (event.charCode>=48 && event.charCode<=57)" required>
                                            <label class = "sr-only" for = "inlineFormInputName2" >Cat??gorie</label>
                                            <select id = "categorie" name = "categorie" class = "nice-select mb-2 mr-sm-2 col-md-2" required>
                                                <option value = "Cat??gorie" selected disabled>Cat??gorie</option>
                                                @if($categories->count() == null)
                                                    <option value = "Aucun" selected disabled>Pas de cat??gorie</option>
                                                @else
                                                    @foreach($categories as $row)
                                                        <option value = "{{$row->nom}}">{{$row->nom}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <button type = "submit" class = "btn btn-primary mb-2" id = "btn_submit2">Cr??er un article</button>
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