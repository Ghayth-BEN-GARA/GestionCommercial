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
                                        <p class = "card-description">Consulter les meilleurs prix par fournisseur</p>
                                        <div class = "form-group row">
                                            <div class = "col-sm-8">
                                                <div class = "table-responsive">
                                                    <table class = "table table-borderless table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Fournisseur</th>
                                                                <th>Article</th>
                                                                <th>Prix</th>
                                                                <th>Date</th>
                                                            </tr>  
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class = "col-sm-4 mt-4">
                                                <caption id = "caption" class = "mt-2 text-center" style = "font-weight:bolder; text-transform:uppercase; 2px 2px #ff0000;"><b class = "text-warning" style = "font-size:40px">.</b> Meilleurs prix par fournisseur <br> <b style = "color:#EAEAF1;font-size:40px">.</b> Historique des prix</caption>
                                            </div>
                                        </div>
                                    </div>
                                    <input type = "hidden" name = "reference" id = "reference" value = "{{$reference}}">
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
            $(function(){
                fetchListeMeilleurPrix();
            });
        </script>
    </body>
</html>