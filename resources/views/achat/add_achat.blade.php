<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/nice-select.css')}}">
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
                                        <form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('/add-facture')}}" onsubmit = "validerFacture()">
                                            @csrf
                                            <fieldset class = "border p-2">
                                                <legend  class = "w-auto">Fournisseur</legend>
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Nom</label>
                                                            <div class = "col-sm-9">
                                                                <select id = "nom" name = "nom" class = "nice-select" required onchange = "setMatriculeFournisseur()">
                                                                    <option value = "Nom" selected disabled>Nom du fournisseur</option>
                                                                    @if($fournisseurs->count() == null)
                                                                        <option value = "Aucun" selected disabled>Pas de fournisseurs disponible pour le moment !</option>
                                                                    @else
                                                                        @foreach($fournisseurs as $row)
                                                                            <option value = "{{$row->nom}}">{{$row->nom}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Matricule</label>
                                                            <div class = "col-sm-9">
                                                                <input type = "text" class = "form-control" name = "matricule" id = "matricule" placeholder = "Saisissez la matricule.." required readonly />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class = "border p-2 mt-4">
                                                <legend  class = "w-auto">Facture</legend>
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Référence</label>
                                                            <div class = "col-sm-9">
                                                                <input type = "text" class = "form-control" name = "referenceF" id = "referenceF" onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32) || (event.charCode>46 && event.charCode<58)" placeholder = "Saisissez la référence du facture.." required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Fait par</label>
                                                            <div class = "col-sm-9">
                                                                <input type = "text" class = "form-control" name = "par" id = "par" placeholder = "Saisissez le nom du responsable.."  onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Date</label>
                                                            <div class = "col-sm-9">
                                                                <input type = "date" class = "form-control" name = "date" id = "date" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Heure</label>
                                                            <div class = "col-sm-9">
                                                                <input type = "time" class = "form-control" name = "heure" id = "heure" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Type</label>
                                                            <div class = "col-sm-9">
                                                                <select id = "type" name = "type" class = "nice-select" required>
                                                                    <option value = "Type" selected disabled>Type de facture</option>
                                                                    <option value = "BL">BL</option>
                                                                    <option value = "FACT">FACT</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Client</label>
                                                            <div class = "col-sm-9">
                                                                <input type = "text" class = "form-control" name = "client" id = "client" placeholder = "Saisissez le nom du client.." value = "Mhamed Abbour" required readonly />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Paiement</label>
                                                            <div class = "col-sm-4">
                                                                <div class = "form-check">
                                                                    <label class = "form-check-label">
                                                                        <input type = "radio" class = "form-check-input paiement" name = "paiement" id = "totale" value = "" checked>
                                                                        Totale
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class = "col-sm-5">
                                                                <div class = "form-check">
                                                                    <label class = "form-check-label">
                                                                        <input type = "radio" class = "form-check-input paiement" name = "paiement" id = "tranche" value = "">
                                                                        Tranche
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Montant</label>
                                                            <div class = "col-sm-9">
                                                                <input type = "text" class = "form-control" name = "paye" id = "paye" placeholder = "Saisissez le montant payé.." required readonly />
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
                                                        <div class = "row margin-top" id = "content_div">
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
                                                <div class = "container table-responsive mt-4">
                                                    <table class = "table table-borderless table-striped" id = "articles_data">
                                                        <thead class = "table-warning">
                                                            <tr>
                                                                <th><div class = "form-check">Désignation</div></th>
                                                                <th><div class = "form-check">Référence</div></th>
                                                                <th><div class = "form-check">Catégorie</div></th>
                                                                <th><div class = "form-check">Quantité</div></th>
                                                                <th><div class = "form-check">Prix unitaire</div></th>
                                                                <th><div class = "form-check">Prix totale</div></th>
                                                                <th><div class = "form-check">Actions</div></th>
                                                            </tr> 
                                                        </thead>
                                                        <tbody id = "body_achat">
                                                            <tr id = "vide">
                                                                <td colspan = "7">Votre facture d'achat est encore vide..</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type = "submit" class = "btn btn-primary mr-2 mt-4" id = "btn_submit" disabled>Remplir la facture</button>
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
        <script src = "{{asset('js/jquery.nice-select.js')}}"></script>
        <script src = "{{asset('vendors/typeahead.js/bootstrap3-typeahead.min.js')}}"></script>
        <script>
            $('#referenceF').on('input',function(){
                initialiserReferenceF();
            });    

            $('#button_add').on('click', function(){
                gestionAjouterLigne();
            });   
            
            $(function(){
                configSelect($('#nom'));
                configSelect($('#type'));
                functionEnabledDisabledMontantPaye();
                searchDesignationFacture();
                searchReferenceFacture();
                searchCategorieFacture();
            });
        </script>
    </body>
</html>