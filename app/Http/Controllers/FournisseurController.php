<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Fournisseur;

    class FournisseurController extends Controller{
        public function openAddFournisseur(){
            $informations = $this->getInformationsUser();
            return view('fournisseur.add_fournisseur',compact('informations'));
        }

        public function getUserController(){
            return new UserController();
        }

        public function getInformationsUser(){
            return $this->getUserController()->getInformationSessionActive($this->getUserController()->getTypeSessionActive());
        }

        public function verifyMatriculeFournisseur(Request $request){
            return Fournisseur::where('matricule', $request->matricule)->get()->isEmpty();
        }

        public function storePersonne(Request $request){
            if(!$this->creerFournisseur($request->matricule,$request->nom,$request->email,$request->adresse,$request->mobile1,$request->mobile2)){
                return back()->with('erreur', 'Pour des raisons techniques, il est impossible de créer un nouvel fournisseur.');
            }

            else{
                return back()->with('success', 'Un nouvel fournisseur a été créé avec succès.');
            }
        }

        public function creerFournisseur($matricule,$nom,$email,$adresse,$tel1,$tel2){
            $fournisseur = new Fournisseur();
            $fournisseur->setMatriculeAttribute($matricule);
            $fournisseur->setNomAttribute($nom);
            $fournisseur->setEmailAttribute($email);
            $fournisseur->setAdresseAttribute($adresse);
            $fournisseur->setTel1Attribute($tel1);
            if($tel2 == null){
                $fournisseur->setTel2Attribute("0");
            }

            else{
                $fournisseur->setTel2Attribute($tel2);
            }
            return $fournisseur->save();
        }

        public function openListFournisseur(){
            $informations = $this->getInformationsUser();
            return view('fournisseur.liste_fournisseur',compact('informations'));
        }

        public function openEditFournisseur($matricule){
            $informations = $this->getInformationsUser();
            $fournisseurs = $this->getInformationsFournisseurs($matricule);
            return view('fournisseur.edit_fournisseur',compact('informations','fournisseurs'));
        }

        public function getInformationsFournisseurs($matricule){
            return Fournisseur::where('matricule',$matricule)->first();
        }

        public function gestionUpdateFournisseur(Request $request){
            if(!$this->updateFournisseur($request->matricule,$request->nom,$request->email,$request->adresse,$request->mobile1,$request->mobile2)){
                return back()->with('erreur', 'Pour des raisons techniques, il est impossible de modifier ce fournisseur.');
            }

            else{
                return back()->with('success', 'Le fournisseur a été modifié avec succès.');
            }
        }

        public function updateFournisseur($matricule,$nom,$email,$adresse,$tel1,$tel2){
            return Fournisseur::where('matricule',$matricule)->update([
                'nom' => $nom,
                'email' => $email,
                'adresse' => $adresse,
                'tel1' => $tel1,
                'tel2' => $tel2,
            ]);
        }

        public function openFournisseur($matricule){
            $informations = $this->getInformationsUser();
            $fournisseurs = $this->getInformationsFournisseurs($matricule);
            return view('fournisseur.fournisseur',compact('informations','fournisseurs'));
        }

        public function getAllFournisseur(){
            return Fournisseur::all()->sortBy('nom');
        }

        public function getMatriculeFournisseur(Request $request){
            return Fournisseur::where('nom', $request->nom)->first()->getMatriculeAttribute();
        }
    }
?>
