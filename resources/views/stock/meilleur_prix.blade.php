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
                                            <div class = "col-sm-6">
                                                <div class = "table-responsive">
                                                    <table class = "table table-borderless table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Fournisseur</th>
                                                                <th>Article</th>
                                                                <th>Meilleur prix</th>
                                                                <th>Action</th>
                                                            </tr>  
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class = "col-sm-6">
                        
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