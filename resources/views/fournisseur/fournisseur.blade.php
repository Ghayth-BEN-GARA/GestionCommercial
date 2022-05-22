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
                                        <h4 class = "card-title">Informations de fournisseur <b style = "color:#F7941E">{{$fournisseurs['nom']}}</b></h4>  
                                        <div class = "table-responsive">
                                            <table class = "table table-bordered">
                                                <thead style = "text-align:center">
                                                    <tr>
                                                        <th>Nom</th>
                                                        <th>Matricule fiscale</th>
                                                        <th>Adresse email</th>
                                                        <th>Adresse</th>
                                                        <th colspan = "2">Numéro mobile </th>
                                                    </tr>
                                                </thead>
                                                <tbody style = "text-align:center">
                                                    <tr>
                                                        <td>{{$fournisseurs['nom']}}</td>
                                                        <td>{{$fournisseurs['matricule']}}</td> 
                                                        <td>{{$fournisseurs['email']}}</td> 
                                                        <td>{{$fournisseurs['adresse']}}</td> 
                                                        <td>{{$fournisseurs->getTel1Attribute()}}</td> 
                                                        <td>{{$fournisseurs->getTel2Attribute()}}</td> 
                                                    </tr> 
                                                </tbody>
                                            </table>
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