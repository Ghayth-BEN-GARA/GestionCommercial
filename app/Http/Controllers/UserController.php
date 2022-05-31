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
                    "type" => $type,
                    "naissanceF" => $this->getNaissanceNotFormattedPersonne($this->getUsernameSessionActive()),
                    "telF" => $this->getTelNotFormattedPersonne($this->getUsernameSessionActive())
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

        public function logoutCompte2(){
            Session::forget('username');
            Session::forget('type');
            Session::flush();
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
                return back()->with("erreur', 'Pour des raisons techniques, il n'est pas possible de créer un nouvel utilisateur.");
            }

            else{
                if(!$this->creerPersonne($request->nom,$request->prenom,$request->genre,$request->naissance,$request->mobile,$request->adresse,$request->cin)){
                    return back()->with('erreur', "Pour des raisons techniques, il n'est pas possible de créer un nouvel utilisateur. Certaines informations peuvent être incorrectes.");
                }
    
                else if(!$this->creerImage($request,$request->cin)){
                    return back()->with('erreur', "Pour des raisons techniques, il n'est pas possible de créer un nouvel utilisateur en raison d'erreurs lors de l'enregistrement de la photo de profil.");
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

        public function getDateCreationCompte($cin){
            return Compte::where('cin', $cin)->first()->getDateCreationAttribute();
        }

        public function getTempsCreationCompte($cin){
            return Compte::where('cin', $cin)->first()->getHeureCreationAttribute();
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

        public function getNaissanceNotFormattedPersonne($cin){
            return Personne::where('cin', $cin)->first()->getNaissanceNotFormattedAttribute();
        }

        public function getTelNotFormattedPersonne($cin){
            return Personne::where('cin', $cin)->first()->getTelNotFormattedAttribute();
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
            File::copy('images/faces/user.png', 'images/uploads/'.$this->getUsernameSessionActive().'/user.png');
                        
            if(Image::where('cin',$this->getUsernameSessionActive())->update(['photo' => 'user.png'])){
                return back()->with('success', "Votre photo de profil a été supprimée avec succès. Vous pouvez ajouter une autre photo à tout moment.");
            }

            else{
                return back()->with('erreur', "Pour des raisons techniques, vous ne pouvez pas supprimer une photo de profil qui n'existe pas ou qu'elle a déjà été supprimée.");
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
                        return back()->with('success', 'Votre photo de profil a été modifiée avec succès. Vous pouvez la consulter ou la modifier une autre fois.');
                    }

                    else{
                        return back()->with('erreur', "Pour des raisons techniques, vous ne pouvez pas supprimer votre photo de profil.");
                    }
                }
            }
            else{
                if($this->creerImage($request,$this->getUsernameSessionActive())){
                    return back()->with('success', 'Votre photo de profil a été modifiée avec succès. Vous pouvez la consulter ou la modifier une autre fois.');
                }

                else{
                    return back()->with('erreur', "Pour des raisons techniques, vous ne pouvez pas supprimer votre photo de profil.");
                }
            }
        }

        public function updatePassword(Request $request){
            if(md5($request->old) != $this->getPasswordCompte($this->getUsernameSessionActive())){
                return back()->with('erreur', "Une erreur s'est produite lors de la modification de votre mot de passe. Vous avez entré un ancien mot de passe incorrect.");
            }

            else{
                $compte = Compte::where('cin',$this->getUsernameSessionActive())->update([
                    'password'=> md5($request->new)
                ]);

                if($compte){
                    return back()->with('success', 'Votre mot de passe a été changé avec succès. Vous pouvez le modifier à nouveau à tout moment.');
                }

                else{
                    return back()->with('erreur', "Pour des raisons techniques, il n'est actuellement pas possible de modifier votre mot de passe.");
                }
            }
        }

        public function updateUser(Request $request){
            $user = Personne::where('cin',$this->getUsernameSessionActive())->update([
                'nom'=>$request->nom,
                'prenom'=>$request->prenom,
                'genre'=>$request->genre,
                'naissance'=>$request->naissance,
                'tel'=>$request->mobile,
                'adresse'=>$request->adresse
            ]);

            if($user){
                return back()->with('success', 'Vos informations ont été modifiées avec succès. Vous pouvez les consulter, les gérer ou les modifier une autre fois.');
            }

            else{
                return back()->with('erreur', "Pour des raisons techniques, vos informations ne peuvent pas être modifiées. Il est possible que vous avez saisi des informations interdites par nos restrictions ou que vous n'avez modifié aucune information.");
            }
        }

        public function gestionDeleteUser(){
            if($this->deleteUser($this->getUsernameSessionActive())){
                File::deleteDirectory(public_path('images/uploads/'.$this->getUsernameSessionActive()));
                $this->logoutCompte2();
                return redirect()->route('login')->with('erreur', 'Votre compte a été supprimé. Vous ne pouvez pas utiliser ce compte maintenant.');
            }

            else{
                return back()->with('erreur', 'Pour des raisons techniques, il est impossible de supprimer votre compte.');
            }
        }

        public function deleteUser($cin){
            return Compte::where('cin',$cin)->delete();
        }

        public function openListUser(){
            $informations = $this->getInformationSessionActive($this->getTypeSessionActive());
            return view('user.liste_user',compact('informations'));
        }

        public static function formatterMobile($tel){
            return substr($tel, 0, 2)." ".substr($tel, 2, 3)." ".substr($tel, 5, 3);
        }

        public function gestionDeleteUtilisateur($cin){
            if($this->deleteUser($cin)){
                File::deleteDirectory(public_path('images/uploads/'.$cin));
                return back()->with('success', 'Cet utilisateur a été supprimé avec succès.');
            }

            else{
                return back()->with('erreur', 'Pour des raisons techniques, il est impossible de supprimer cet utilisateur.');
            }
        }

        public function openProfilUser($cin){
            $informations = $this->getInformationSessionActive($this->getTypeSessionActive());
            $user = $this->getInformationsUser($cin);
            
            return view('user.profil',compact('informations','user'));
        }

        public function getInformationsUser($cin){
            return [
                "fullname" => $this->getPrenomPersonne($cin) ." ".$this->getNomPersonne($cin),
                "image" => '../'.$this->getPhotoUser($cin),
                "tel" => $this->getMobilePersonne($cin),
                "cin" => $cin,
                "nom" => $this->getNomPersonne($cin),
                "prenom" => $this->getPrenomPersonne($cin),
                "genre" => $this->getGenrePersonne($cin),
                "naissance" => $this->getNaissancePersonne($cin),
                "adresse" => $this->getAdressePersonne($cin),
                "type" => $this->getTypeCompte($cin),
                "naissanceF" => $this->getNaissanceNotFormattedPersonne($cin),
                "telF" => $this->getTelNotFormattedPersonne($cin)
            ];
        }

        public function getPhotoUser($cin){
            $image = Image::where('cin', $cin)->first();
            if($image == null){
                return 'images/faces/user.png';
            }

            else{
                $im = $image->getPhotoAttribute();
                return "images/uploads/".$cin.'/'.$im;
            }
        }
    }
?>
