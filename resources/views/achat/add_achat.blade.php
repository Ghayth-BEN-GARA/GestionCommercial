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
                                        <form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('/add-facture')}}" onsubmit = "validerFacture()">
                                            @csrf
                                            <fieldset class = "border p-2">
                                                <legend  class = "w-auto">Fournisseur</legend>
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Nom</label>
                                                            <div class = "col-sm-9">
                                                                <select id = "nom" name = "nom" class = "form-control" required onchange = "setMatriculeFournisseur()">
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
                                                                    <input type = "text" class = "form-control" name = "referenceF" id = "referenceF" onkeypress = "return event.charCode>=48 && event.charCode<=57" placeholder = "Saisissez la référence du facture.." required/>
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
                                                                <input type = "time" class = "form-control" name = "heure" id = "heure"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Type</label>
                                                            <div class = "col-sm-9">
                                                                <select id = "type" name = "type" class = "form-control" required>
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
                                                            <label class = "col-sm-3 col-form-label">Montant payé</label>
                                                            <div class = "col-sm-9">
                                                                <input type = "text" class = "form-control" name = "paye" id = "paye" placeholder = "Saisissez le montant payé.." required disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <br>
                                            <button type = "submit" class = "btn btn-primary mr-2" disabled id = "btn_submit">Suivant</button>
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
        <script>
            $('.paiement').on('click', function(){
                enabledDisabledMontantPaye();
			});

            $('#referenceF').on('input',function(){
                initialiserReferenceF();
            });            
        </script>
    </body>
</html>