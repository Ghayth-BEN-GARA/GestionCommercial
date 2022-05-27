<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Facture;
    use App\Models\FactureArticle;

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

        public function verifyReferenceFacture2($referenceF){
            return Facture::where('referenceF', $referenceF)->get()->isEmpty();
        }

        public function gestionStoreFacture(Request $request){
            if(!$this->verifyReferenceFacture2($request->nom.'/'.$request->referenceF)){
                return back()->with('erreur', 'Une autre facture est déjà créé avec cette référence..');
            }

            else{
                if(!$this->creerEnteteFacture($request->nom,$request->referenceF,$request->date,$request->heure,$request->type,$request->par,$request->matricule)){
                    return back()->with('erreur', 'Pour des raisons techniques, il est impossible de créer un nouvelle facture.');
                }
    
                else{
                    if($this->getArticleController()->storeArticleToFacture($request)){
                        return back()->with('success', 'Une nouvelle facture a été créé avec succès.');
                    }
    
                    else{
                        return back()->with('erreur', 'Pour des raisons techniques, il est impossible de créer un nouvelle facture.');
                    }
                }
            }
        }

        public function creerEnteteFacture($nom,$reference,$date,$heure,$type,$par,$matricule){
            $facture = new Facture();
            $facture->setReferenceFAttribute($nom.'/'.$reference);
            $facture->setDateAttribute($date);
            $facture->setHeureAttribute($heure);
            $facture->setTypeAttribute($type);
            $facture->setParAttribute($par);
            $facture->setMatriculeAttribute($matricule);
            return $facture->save();
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

        public function getArticleController(){
            return new ArticleController();
        }

        public function getStockController(){
            return new StockController();
        }

        public function openListAchat(){
            $informations = $this->getInformationsUser();
            return view('achat.liste_achat',compact('informations'));
        }

        public function gestionDeleteFacture(Request $request){
            $this->getStockController()->gestionDeleteStock($request->Input('reference'));
            if($this->deleteFacture($request->Input('reference'))){
                return back()->with('success', 'Cette facture a été supprimée avec succès.');
            }

            else{
                return back()->with('erreur', 'Pour des raisons techniques, il est impossible de supprimer cette facture.');
            }
        }

        public function deleteFacture($referenceF){
            return Facture::where('referenceF',$referenceF)->delete();
        }

        public function openAchat(Request $request){
            $informations = $this->getInformationsUser();
            $facture = $this->getInformationsFacture($request->Input('reference'));
            $article = $this->getListeArticlesFromFacture($request->Input('reference'));
            return view('achat.achat',compact('informations','facture','article'));
        }

        public function getInformationsFacture($referenceF){
            $facture = Facture::where('referenceF', '=', $referenceF)->first();
        
            return [
                'type' => $facture->getTypeAttribute(),
                'referenceF' => $referenceF,
                'nom' => $this->getFournisseurController()->getInformationsFournisseurs($facture->getMatriculeAttribute())->getNomAttribute(),
                'adresse' => $this->getFournisseurController()->getInformationsFournisseurs($facture->getMatriculeAttribute())->getAdresseAttribute(),
                'tel1' => $this->getFournisseurController()->getInformationsFournisseurs($facture->getMatriculeAttribute())->getTel1Attribute(),
                'tel2' => $this->getFournisseurController()->getInformationsFournisseurs($facture->getMatriculeAttribute())->getTel2Attribute(),
                'email' => $this->getFournisseurController()->getInformationsFournisseurs($facture->getMatriculeAttribute())->getEmailAttribute(),
                'matricule' => $facture->getMatriculeAttribute(),
                'date' => $facture->getDateAttribute(),
                'heure' => $facture->getHeureAttribute(),
                'par' => $facture->getParAttribute(),
                'credit' => $this->getReglementController()->getCreditFournisseur($referenceF)
            
            ];
        }

        public function getListeArticlesFromFacture($referenceF){
            return FactureArticle::join('factures', 'factures.referenceF', '=', 'facturesarticles.referenceF')
            ->join('articles', 'articles.reference', '=', 'facturesarticles.reference')
            ->where('facturesarticles.referenceF', '=', $referenceF)
            ->get(['factures.*', 'articles.*','facturesarticles.*']);
        }

        public static function stylingPrix($prix){
            if($prix == 0){
                return "0 DT";
            }

            else if(strlen($prix) < 4){
                return ("0.".$prix." DT");
            }

            else{
                $ch1 = substr($prix,strlen($prix)-3,3);
                $ch2 = substr($prix,0,-3);
                return ($ch2.".".$ch1." DT");
            }
        }

        public function getReglementController(){
            return new ReglementController();
        }

        public function getFirstDate($matricule){
            return Facture::where('matricule',$matricule)->orderBy('date','asc')->first();
        }

        public function getLastDate($matricule){
            return Facture::where('matricule',$matricule)->orderBy('date','desc')->first();
        }
    }   
?>
