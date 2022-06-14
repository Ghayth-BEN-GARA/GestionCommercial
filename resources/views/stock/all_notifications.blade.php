<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/toast.css')}}">
        <link rel = "stylesheet" href = "{{asset('css/pagination.css')}}">
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
                                        <p class = "card-description">Valider toutes les notifications instantanément</p>
                                        <div class = "container">
                                            <div class = "card card-toast ss">
                                                <div class = "toast-content">
                                                    <i class = "mdi mdi-check check"></i>
                                                    <div class = "message">
                                                        <span class = "text text-1">Prix validé</span>
                                                        <span class = "text text-2">Le nouveau prix d'achat a été validé avec succès.</span>
                                                    </div>
                                                </div>
                                                <i class = "mdi mdi-close close"></i>
			                                    <div class = "progress-toast-ss"></div>
                                            </div>
		                                </div>
                                        <div class = "container">
                                            <div class = "card card-toast err">
                                                <div class = "toast-content">
                                                    <i class = "mdi mdi-exclamation error"></i>
                                                    <div class = "message">
                                                        <span class = "text text-1">Prix non validé</span>
                                                        <span class = "text text-2">Le nouveau prix d'achat ne peut être validé.</span>
                                                    </div>
                                                </div>
                                                <i class = "mdi mdi-close close"></i>
			                                    <div class = "progress-toast-err"></div>
                                            </div>
		                                </div>
                                        <div class = "table-responsive">
                                            <table class = "table table-borderless table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Article</th>
                                                        <th>Catégorie</th>
                                                        <th>Prix d'achat actuel</th>
                                                        <th>Prix d'achat suggéré</th>
                                                        <th>Prix d'achat choisi</th>
                                                    </tr>  
                                                </thead>
                                                <tbody>
                                                    @if($listeNotifications->count() == null)
                                                        <tr>
                                                            <td colspan = "5">Pas des notifications n'est enregistré dans votre application..</td>
                                                        </tr>
                                                    @else
                                                        @foreach($listeNotifications as $row)
                                                            <tr id = "row_{{$row->reference}}">
                                                                <td class = "font-weight-bold"><div class = "badge badge-danger">{{$row->designation}}</div></td>
                                                                <td>{{($row->categorie)}}</td>
                                                                <td>{{App\Http\Controllers\FactureController::stylingPrix($row->prix)}}</td>
                                                                <td class = "font-weight-bold"><div class = "badge badge-success">{{App\Http\Controllers\FactureController::stylingPrix($row->p)}}</div></td>
                                                                <td>
                                                                    <form class = "forms-sample mt-4" id = "f" name = "f" method = "post" action = "javascript:void(0)">
                                                                        @csrf
                                                                        <div class = "col-md-12">
                                                                            <div class = "form-group row">
                                                                                <div class = "col-sm-5">
                                                                                    <input type = "number" class = "form-control" name = "prix" id = "prix_{{$row->id}}" placeholder = "Prix.." onkeypress = "return event.charCode>=48 && event.charCode<=57" required>
                                                                                </div>
                                                                                <div class = "col-sm-3 mt-3">
                                                                                    Millime(s)
                                                                                </div>
                                                                                <div class = "col-sm-3">
                                                                                    <button type = "button" class = "btn btn-primary" id = "btn_{{$row->id}}" onclick = "validerInputPrix('{{$row->id}}')">Valider</button>
                                                                                </div>
                                                                                <input type = "hidden" class = "form-control" name = "reference" id = "ref_{{$row->id}}" value = "{{$row->reference}}" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class = "container">
                                            {{$listeNotifications->links('vendor.pagination.normal_pagination')}}
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