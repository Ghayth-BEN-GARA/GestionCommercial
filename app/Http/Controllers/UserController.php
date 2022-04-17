<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Session;
    use File;
    use App\Models\Compte;
    use App\Models\Personne;
    use App\Models\Image;

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

        public function openAddCompte(){
            $informations = $this->getInformationSessionActive($this->getTypeSessionActive());
            return view('user.add_user',compact('informations'));
        }

        public function verifyCompte(Request $request){
            if($request->cin == '12345678'){
                return ('admin');
            }

            else{
                return Compte::where('cin', $request->cin)->get()->isEmpty();
            }
        }

        public function storeCompte(Request $request){
            if(!$this->creerCompte($request->cin,$request->password,$request->type)){
                return back()->with('erreur', 'Pour des raisons techniques, il est impossible de créer un nouvelle utilisateur.');
            }

            else{
                if(!$this->creerPersonne($request->nom,$request->prenom,$request->genre,$request->naissance,$request->mobile,$request->adresse,$request->cin)){
                    return back()->with('erreur', 'Pour des raisons techniques, il est impossible de créer un nouvelle utilisateur.');
                }
    
                else if(!$this->creerImage($request,$request->cin)){
                    return back()->with('erreur', 'Pour des raisons techniques, il est impossible de créer un nouvelle utilisateur.');
                }

                else{
                    return back()->with('success', 'Un nouvel utilisateur a été créé avec succès. Il peut utiliser son compte normalement.');
                }
            }         
        }

        public function creerCompte($cin,$password,$type){
            $compte = new Compte();
            $compte->setCinAttribute($cin);
            $compte->setPasswordnAttribute($password);
            $compte->setTypeAttribute($type);
            $compte->setDateCreationAttribute();
            $compte->setHeureCreationAttribute();
            return $compte->save();
        }

        public function creerPersonne($nom,$prenom,$genre,$naissance,$tel,$adresse,$cin){
            $personne = new Personne();
            $personne->setNomAttribute($nom);
            $personne->setPrenomAttribute($prenom);
            $personne->setGenreAttribute($genre);
            $personne->setNaissanceAttribute($naissance);
            $personne->setTelAttribute($tel);
            $personne->setAdresseAttribute($adresse);
            $personne->setCinAttribute($cin);
            return $personne->save();
        }

        public function creerImage($request,$cin){
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = date('Y-m-d') . '_' . time() . '.' .$extension;
                $file->move('images/uploads/'.$cin,$filename);
                
                $image = new Image();
                $image->setPhotoAttribute($filename);
                $image->setCinAttribute($cin);     
                return $image->save();              
            }
        }
    }
?>
