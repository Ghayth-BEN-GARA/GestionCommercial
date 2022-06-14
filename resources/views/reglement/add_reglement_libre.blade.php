<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
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
                                        <h4 class = "card-title">Réglements</h4>
                                        <p class = "card-description">Ajouter un réglement libre</p>
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
                                        <form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('/store-reglement-libre')}}">
                                            @csrf
                                            <div class = "form-group row">
                                                <label for = "exampleInputEmail2" class = "col-sm-3 col-form-label">Nom du fournisseur</label>
                                                <div class = "col-sm-7">
                                                    <input type = "text" class = "form-control" name = "nom" id = "nom" placeholder = "Saisissez le nom.." value = '{{$nom}}' required readonly />
                                                </div>
                                            </div>
                                            <div class = "form-group row">
                                                <label for = "exampleInputEmail2" class = "col-sm-3 col-form-label">Matricule du fournisseur</label>
                                                <div class = "col-sm-7">
                                                    <input type = "text" class = "form-control" name = "matricule" id = "matricule" placeholder = "Saisissez la matricule.." value = '{{$matricule}}' required readonly />
                                                </div>
                                            </div>
                                            <div class = "form-group row">
                                                <label for = "exampleInputEmail2" class = "col-sm-3 col-form-label">Date du réglement</label>
                                                <div class = "col-sm-7">
                                                    <input type = "date" class = "form-control" name = "date" id = "date" required />
                                                </div>
                                            </div>
                                            <div class = "form-group row">
                                                <label for = "exampleInputEmail2" class = "col-sm-3 col-form-label">Montant payé</label>
                                                <div class = "col-sm-7">
                                                    <input type = "number" class = "form-control" name = "paye" id = "paye" placeholder = "Saisissez le montant payé.." required />
                                                </div>
                                                <div class = "mt-3">
                                                    <span> Millime(s)</span>
                                                </div>
                                            </div>
                                            <div class = "col-md-12">
	            	                            <button type = "submit" class = "btn btn-primary me-2" id = "btn_submit">Ajouter le réglement</button>
                                            </div>
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
        </script>
    </body>
</html>