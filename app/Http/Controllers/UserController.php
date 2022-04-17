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
                return redirect()->route('home');
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
            $informations = $this->getInformationSessionActive($this->getTypeSessionActive());
            return view('home',compact('informations'));
        }

        public function getTypeSessionActive(){
            return (Session::get('type')); 
        }

        public function getInformationSessionActive($type){
            if($type == "Administrateur"){
                return [
                    "fullname" => "Administrateur",
                    "image" => "images/logo/favicon.png",
                    "fonction" => "Directeur" 
                ];
            }
        }

        public function logoutCompte(){
            Session::forget('username');
            Session::forget('type');
            Session::flush();
            if (!Session::has('username')){
                return redirect()->route('login');
            }
        }
    }
?>
