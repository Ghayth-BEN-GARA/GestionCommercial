<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head_login')
    </head>
    <body>
        <div class = "content">
            <div class = "container">
                <div class = "row">
                    <div class = "col-md-6">
                        <img src = "{{asset('login/images/undraw_remotely_2j6y.svg')}}" alt = "Image" class = "img-fluid">
                    </div>
                    <div class = "col-md-6 contents">
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
                        <div class = "row justify-content-center">
                            <div class = "col-md-8">
                                <div class = "mb-4">
                                <h3>Connexion</h3>
                                <p class = "mb-4">Content de te revoir !<br>Connectez-vous pour continuer.</p>
                            </div>
                            <form action = "{{url('/signin')}}" method = "post" name = "f" id = "f">
                                @csrf
                                <div class = "form-group first">
                                    <input type = "text" class = "form-control" id = "cin" name = "cin" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" placeholder = "Entrez votre CIN.." required>
                                </div>
                                <br>
                                <div class = "form-group last mb-4">
                                    <input type = "password" class = "form-control" id = "password" name = "password" placeholder = "Entrez votre password.." required>
                                </div>
                                <div class = "d-flex mb-5 align-items-center">
                                    <label class = "control control--checkbox mb-0"><span class = "caption">Me rappeler</span>
                                        <input type = "checkbox" checked = "checked"/>
                                        <div class = "control__indicator"></div>
                                    </label>
                                </div>
                                <input type = "submit" value = "Se connecter" class = "btn btn-block btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include ('layouts.script_login')
    </body>  
</html>