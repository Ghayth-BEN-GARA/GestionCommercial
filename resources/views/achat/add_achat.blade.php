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
                                            <br>
                                            <fieldset class = "border p-2">
                                                <legend  class = "w-auto">Facture</legend>
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Référence</label>
                                                            <div class = "col-sm-9">
                                                                <div class = "input-group">
                                                                    <input type = "text" class = "form-control" name = "referenceF" id = "referenceF" onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32) || (event.charCode>46 && event.charCode<58)" placeholder = "Saisissez la référence du facture.." required/>
                                                                    <div class = "input-group-append">
                                                                        <button class = "btn btn-sm btn-primary" type = "button" onclick = "verifierReferenceFacture()">Vérifier</button>
                                                                    </div>
                                                                </div>
                                                                <span class = "error" id = "referenceF_error"></span>
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
                                            <br>
                                            <fieldset class = "border p-2">
                                                <legend  class = "w-auto">Articles</legend>
                                                <table class = "table table-striped table-borderless" id = "article">
                                                    <thead>
                                                        <tr>
                                                            <th>Désignation</th>
                                                            <th>Référence</th>
                                                            <th>Catégorie</th>
                                                            <th>Quantité
                                                            <th>Prix unitaire</th>
                                                            <th>Prix totale</th>
                                                            <th>Action</th>
                                                        </tr>  
                                                    </thead>
                                                    <tbody>
                                                        <tr id = "row0">
                                                            <td class = "styleInput"><input type = "text" class = "form-control" name = "designation[]" id = "designation0" placeholder = "Désignation.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" required></td>
                                                            <td class = "styleInput"><input type = "text" class = "form-control" name = "reference[]" id = "reference0" placeholder = "Référence.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required></td>
                                                            <td class = "styleInput"><input type = "text" class = "form-control" name = "categorie[]" id = "categorie0" placeholder = "Catégorie.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32)" required></td>
                                                            <td><input type = "number" class = "form-control" name = "quantite[]" id = "quantite0" placeholder = "Quantité.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required></td>
                                                            <td class = "styleInput"><input type = "number" class = "form-control" name = "prix[]" id = "prix0" placeholder = "Prix.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required></td>
                                                            <td class = "table-warning"><span id = "prixT0" name = "prixT[]">0 DT</span></td>
                                                            <td><button class = "btn btn-success mr-2" id = "add_item_btn" type = "button">Ajouter</button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </fieldset>
                                            <br>
                                            <button type = "submit" class = "btn btn-primary mr-2" id = "btn_submit" disabled>Créer une facture</button>
                                            <button type = "reset" class = "btn btn-light">Annuler</button>
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
        <script src = "{{asset('js/jquery.nice-select.js')}}"></script>
        <script>
            $('#referenceF').on('input',function(){
                initialiserReferenceF();
            });        
            
            var compteur = 0;

            $(function(){
                configSelect($('#nom'));
                configSelect($('#type'));
                searchDesignationFacture(compteur);
                searchReferenceFacture(compteur);
                searchCategorieFacture(compteur);
                functionCalculerPrixTotale(compteur); 
                functionCliqueAjouterLigne();  
                functionCliqueSupprimerLigne();  
                functionEnabledDisabledMontantPaye();
            });  

            $('#f').submit(function() {
				$('#btn_submit').prop('disabled', true);
                $("#f").submit();
         	});
        </script>
    </body>
</html>