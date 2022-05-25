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
                                        <form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('/add-facture-articles')}}" onsubmit = "validerFacture()">
                                            @csrf
                                            <fieldset class = "border p-2">
                                                <legend  class = "w-auto">Facture</legend>
                                                <div class = "row">
                                                    <div class = "col-md-6">
                                                        <div class = "form-group row">
                                                            <label class = "col-sm-3 col-form-label">Référence</label>
                                                            <div class = "col-sm-9">
                                                                <select id = "referenceF" name = "referenceF" class = "nice-select" required>
                                                                    <option value = "Référence" selected disabled>Référence du facture</option>
                                                                    @if($factures->count() == null)
                                                                        <option value = "Aucun" selected disabled>Pas de factures disponible pour le moment !</option>
                                                                    @else
                                                                        @foreach($factures as $row)
                                                                            <option value = "{{$row->referenceF}}">{{$row->referenceF}}</option>
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
                                            <button type = "submit" class = "btn btn-primary mr-2 mt-4" id = "btn_submit" disabled>Créer une facture</button>
                                            <button type = "reset" class = "btn btn-light mt-4">Annuler</button>
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
            $('#referenceF').on('input',function(){
                initialiserReferenceF();
            });    
            
            $(function(){
                configSelect($('#nom'));
                configSelect($('#type'));
            });
        </script>
    </body>
</html>