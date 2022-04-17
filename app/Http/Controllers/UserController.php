<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Session;

    class UserController extends Controller{
        public function openSignIn(){
            return view('login');
        }

        public function loginCompte(Request $request){
            if($request->cin == "12345678" && $request->password == "admin"){
                $this->creerSession($request->cin,"Administrateur");
                $this->openHome();
            }

            else{
                return back()->with('erreur', 'Le CIN ou / et le mot de passe saisi est invalide..');
            }
        }

        public function creerSession($cin,$type){
            Session::put('username', $cin);
            Session::put('type', $type);
        }

        public function openHome(){
            return view('home');
        }
    }
?>
