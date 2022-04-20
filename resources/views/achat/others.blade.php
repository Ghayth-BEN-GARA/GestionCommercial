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
                                        <h4 class = "card-title">Achat</h4>
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
                                        <p class = "card-description">Créer une catégorie</p>
                                        <form class = "form-inline" name = "f" id = "f" method = "post" action = "{{url('/add-categorie')}}">
                                            @csrf
                                            <label class = "sr-only" for = "inlineFormInputName2">Catégorie</label>
                                            <input type = "text" class = "form-control mb-2 mr-sm-2" id = "nom" name = "nom" placeholder = "Saisissez la catégorie.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" required>
                                            <button type = "submit" class = "btn btn-primary mb-2">Créer la catégorie</button>
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
        <script src = "{{asset('js/file-upload.js')}}"></script>
    </body>
</html>