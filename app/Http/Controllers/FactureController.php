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
                $reference = $request->referenceF;
                return redirect()->route('add-articles-achat',[$reference]);
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

        public function openAddArticleToFacture($reference){
            $informations = $this->getInformationsUser();
            return view('achat.add_articles',compact('informations','reference'));
        }

        public function getReferenceFactureSearch(Request $request){
            if($request->get('query') != ''){
                $facture = Facture::where('referenceF', 'LIKE', '%'.$request->get('query').'%')->get();
            }
            
            $data = array();
            foreach ($facture as $fact){
                $data[] = $fact->getReferenceFAttribute().""; 
            }
            echo json_encode($data);
        }
    }
?>
