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

            else if($this->verifyCompte($request)){
                return back()->with('erreur', 'Aucun compte trouvé avec ce CIN..');
            }

            else if(!$this->verifyCompte($request) && $this->getPasswordCompte($request->cin) == md5($request->password)){
                if($this->getTypeCompte($request->cin) == "Admin"){
                    $this->creerSession($request->cin,"Admin");
                    return redirect()->route('home');
                }

                else{
                    $this->creerSession($request->cin,"User");
                    return redirect()->route('home');
                }
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

        public function getUsernameSessionActive(){
            return (Session::get('username')); 
        }

        public function getInformationSessionActive($type){
            if($type == "Administrateur"){
                return [
                    "fullname" => "Administrateur",
                    "image" => "images/logo/favicon.png"
                ];
            }

            else{
                return [
                    "fullname" => $this->getPrenomPersonne($this->getUsernameSessionActive()) ." ".$this->getNomPersonne($this->getUsernameSessionActive()),
                    "image" => $this->getPhotoPersonne($this->getUsernameSessionActive()),
                    "tel" => $this->getMobilePersonne($this->getUsernameSessionActive()),
                    "cin" => $this->getUsernameSessionActive(),
                    "nom" => $this->getNomPersonne($this->getUsernameSessionActive()),
                    "prenom" => $this->getPrenomPersonne($this->getUsernameSessionActive()),
                    "genre" => $this->getGenrePersonne($this->getUsernameSessionActive()),
                    "naissance" => $this->getNaissancePersonne($this->getUsernameSessionActive()),
                    "adresse" => $this->getAdressePersonne($this->getUsernameSessionActive()),
                    "type" => $type
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

        public function getPasswordCompte($cin){
            return Compte::where('cin', $cin)->first()->getPasswordAttribute();
        }

        public function getTypeCompte($cin){
            return Compte::where('cin', $cin)->first()->getTypeAttribute();
        }

        public function getNomPersonne($cin){
            return Personne::where('cin', $cin)->first()->getNomAttribute();
        }

        public function getPrenomPersonne($cin){
            return Personne::where('cin', $cin)->first()->getPrenomAttribute();
        }

        public function getPhotoPersonne($cin){
            $image = Image::where('cin', $cin)->first();
            if($image == null){
                return 'images/faces/user.png';
            }

            else{
                $im = $image->getPhotoAttribute();
                return "images/uploads/".$this->getUsernameSessionActive().'/'.$im;
            }
        }

        public function getMobilePersonne($cin){
            return Personne::where('cin', $cin)->first()->getTelAttribute();
        }

        public function getGenrePersonne($cin){
            return Personne::where('cin', $cin)->first()->getGenreAttribute();
        }

        public function getNaissancePersonne($cin){
            return Personne::where('cin', $cin)->first()->getNaissanceAttribute();
        }

        public function getAdressePersonne($cin){
            return Personne::where('cin', $cin)->first()->getAdresseAttribute();
        }

        public function openProfil(){
            $informations = $this->getInformationSessionActive($this->getTypeSessionActive());
            return view('user.user',compact('informations'));
        }

        public function openEditImageProfil(){
            $informations = $this->getInformationSessionActive($this->getTypeSessionActive());
            return view('user.edit_image_user',compact('informations'));
        }

        public function deleteImage(){
            File::deleteDirectory(public_path('images/uploads/'.$this->getUsernameSessionActive()));
            if(Image::where('cin',$this->getUsernameSessionActive())->delete()){
                return back()->with('success', 'Votre photo de profil a été supprimée avec succès.');
            }

            else{
                return back()->with('erreur', 'Pour des raisons techniques, il est impossible de supprimer votre photo de profil.');
            }
        }

        public function verifyPhoto($cin){
            return Image::where('cin', $cin)->get()->isEmpty();
        }

        public function updateImage(Request $request){
            if(!$this->verifyPhoto($this->getUsernameSessionActive())){
                if($request->hasFile('image')){
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = date('Y-m-d') . '_' . time() . '.' .$extension;
                    File::deleteDirectory(public_path('images/uploads/'.$this->getUsernameSessionActive()));
                    $file->move('images/uploads/'.$this->getUsernameSessionActive(),$filename);
                    $image = Image::where('cin',$this->getUsernameSessionActive())->update([
                        'photo'=>$filename,
                        'cin'=>$this->getUsernameSessionActive()
                    ]);
                    if($image){
                        return back()->with('success', 'Votre photo de profil a été modifié avec succès.');
                    }

                    else{
                        return back()->with('erreur', 'Pour des raisons techniques, il est impossible de modifier votre photo de profil.');
                    }
                }
            }
            else{
                if($this->creerImage($request,$this->getUsernameSessionActive())){
                    return back()->with('success', 'Votre photo de profil a été modifié avec succès.');
                }

                else{
                    return back()->with('erreur', 'Pour des raisons techniques, il est impossible de modifier votre photo de profil.');
                }
            }
        }

        public function openEditPasswordProfil(){
            $informations = $this->getInformationSessionActive($this->getTypeSessionActive());
            return view('user.edit_password_user',compact('informations'));
        }
    }
?>
