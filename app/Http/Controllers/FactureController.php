<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Facture;

    class FactureController extends Controller{
        public function getUserController(){
            return new UserController();
        }

        public function getInformationsUser(){
            return $this->getUserController()->getInformationSessionActive($this->getUserController()->getTypeSessionActive());
        }

        public function getFournisseurController(){
            return new FournisseurController();
        }

        public function getInformationsFournisseurs(){
            return $this->getFournisseurController()->getAllFournisseur();
        }

        public function openAddFacture(){
            $informations = $this->getInformationsUser();
            $fournisseurs = $this->getInformationsFournisseurs();
            return view('achat.add_achat',compact('informations','fournisseurs'));
        }

        public function verifyReferenceFacture(Request $request){
            return Facture::where('referenceF', $request->referenceF)->get()->isEmpty();
        }

        public function storeFacture(Request $request){
            if(!$this->creerFacture($request->referenceF,$request->date,$request->heure,$request->type,$request->par,$request->matricule)){
                return back()->with('erreur', 'Pour des raisons techniques, il est impossible de créer un nouvelle facture.');
            }

            else{
                $informations = $this->getInformationsUser();
                $referenceFacture = $request->referenceF;
                return view('achat.add_articles',compact('informations','referenceFacture'));
            }
        }

        public function creerFacture($reference,$date,$heure,$type,$par,$matricule){
            $facture = new Facture();
            $facture->setReferenceFAttribute($reference);
            $facture->setDateAttribute($date);
            $facture->setHeureAttribute($heure);
            $facture->setTypeAttribute($type);
            $facture->setParAttribute($par);
            $facture->setMatriculeAttribute($matricule);
            return $facture->save();
        }
    }
?>
