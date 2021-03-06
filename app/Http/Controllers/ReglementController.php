<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Reglement;
    use App\Models\Facture;
    use App\Models\Fournisseur;

    class ReglementController extends Controller{
        public function creerReglement($net,$paye,$reference,$matricule,$date){
            $reglement = new Reglement();
            $reglement->setNetAttribute($net);
            $reglement->setPayeAttribute($paye);
            $reglement->setDateAttribute($date);
            $reglement->setMatriculeAttribute($matricule);
            $reglement->setReferenceFAttribute($reference);
            return $reglement->save();
        }

        public function getReglementFacture($referenceF){
            return Reglement::where('referenceF', '=', $referenceF)->get();
        }

        public function getCreditFournisseur($referenceF){
            $sommeAPaye = 0;
            $sommePaye = 0;
            $ch = "";

            foreach ($this->getReglementFacture($referenceF) as $value) {
                if (is_numeric($value->getNetAttribute()) && is_numeric($value->getPayeAttribute())){
                    $sommeAPaye = $sommeAPaye + $value->getNetAttribute();
                    $sommePaye = $sommePaye + $value->getPayeAttribute();
                }
            }

            $montant = $sommeAPaye - $sommePaye;
            if($montant < 0){
                $ch = "Le fournisseur doit payer ".$this->getFactureController()->stylingPrix($sommePaye - $sommeAPaye)." pour vous.";
            }

            else if($montant > 0){
                $ch = "Vous devez payer ".$this->getFactureController()->stylingPrix($sommeAPaye - $sommePaye)." pour ce fournisseur.";
            }

            else{
                $ch = "Aucun crédit trouvé avec ce fournisseur.";
            }
            return $ch;
        }

        public function getFactureController(){
            return new FactureController();
        }

        public function openListReglement(){
            $informations = $this->getFactureController()->getInformationsUser();
            return view('reglement.liste_reglement',compact('informations'));
        }

        public function openReglement(Request $request){
            $informations = $this->getFactureController()->getInformationsUser();
            $reglements = $this->getInformationsReglements($request->Input('matricule'));
            $listeReglements = $this->getAllInformationsReglements($request->Input('matricule'));
            $fournisseur = $this->getFournisseurController()->getInformationsFournisseurs($request->Input('matricule'));
            $matricule = $request->Input('matricule');
            $soldeCredit = $this->getCreditReglementFournisseur($matricule);
            $montantReglement = $this->getSommeMontantPaye($matricule);
            return view('reglement.reglement',compact('informations','reglements','listeReglements','fournisseur','matricule','soldeCredit','montantReglement'));
        }

        public function getFournisseurController(){
            return new FournisseurController();
        }

        public function getLastDate($matricule){
            return Reglement::where('matricule',$matricule)->orderBy('date','desc')->first();
        }

        public function getInformationsReglements($matricule){
            return [
                'nom' => $this->getFournisseurController()->getInformationsFournisseurs($matricule)->getNomAttribute(),
                'lastData' => $this->getLastDate($matricule)->getDateAttribute(),
                'firstData' => $this->getFactureController()->getFirstDate($matricule)->getDateAttribute(),
                'matricule' => $matricule,
                'solde' => $this->getSoldeReglements($matricule),
                'count' => $this->getCountReglement($matricule)
            ];
        }

        public function getSoldeReglements($matricule){
            return Facture::join('reglements', 'reglements.referenceF', '=', 'factures.referenceF')
                ->where('factures.matricule', '=', $matricule)
                ->sum('reglements.net');
        }

        public function getCountReglement($matricule){
            return Facture::join('reglements', 'reglements.referenceF', '=', 'factures.referenceF')
                ->where('factures.matricule', '=', $matricule)
                ->count('factures.matricule');
        }

        public function openErrorPage(){
            return view('errors.500');
        }

        public function getAllInformationsReglements($matricule){
            return Reglement::where('reglements.matricule', '=', $matricule)
                ->orderBy('reglements.date','desc')
                ->get(array('reglements.*'));
        }

        public static function getCreditReglement($net,$paye){
            $fact = new FactureController;
            if (is_numeric($paye) && is_numeric($net)){
                if($paye < $net){
                    return ('Vous devez payé '.$fact->stylingPrix($net - $paye));
                }
    
                else if($paye > $net){
                    return ('Le fourniseur doit payé '.$fact->stylingPrix($paye - $net));
                }
    
                else{
                    return ('Pas de crédit.');
                }
            }
        }

        public function openEditReglement(Request $request){
            $informations = $this->getFactureController()->getInformationsUser();
            $listeReglements = $this->getAllInformationsReglementsEdit($request->Input('matricule'));
            
            return view('reglement.edit_reglement',compact('informations','listeReglements'));
        }

        public function gestionEditReglement(Request $request){
            if($this->editReglement($request->ref,$request->paye)){
                return back()->with('success', 'Le réglement a été modifié avec succès.');
            }

            else{
                return back()->with('erreur', 'Pour des raisons techniques, il est impossible de modifier ce réglement.');
            }
        }

        public function editReglement($referenceF,$paye){
            return Reglement::where('referenceF',$referenceF)->update([
                'paye' => $paye
            ]);
        }

        public function openFactureReglement(Request $request){
            $informations = $this->getFactureController()->getInformationsUser();
            $fournisseur = $this->getFournisseurController()->getInformationsFournisseurs($request->Input('matricule'));
            $informationsReglemens = $this->getInformationsReglements($request->Input('matricule'));
            $informationsFactures = $this->getReglementsParFacture($request->Input('matricule'));

            return view('reglement.facture_reglement',compact('informations','fournisseur','informationsReglemens','informationsFactures'));
        }

        public function getReglementsParFacture($matricule){
            return Facture::join('fournisseurs', 'fournisseurs.matricule', '=', 'factures.matricule')
            ->join('facturesarticles','factures.referenceF','=','facturesarticles.referenceF')
            ->join('articles','facturesarticles.reference','=','articles.reference')
            ->where('factures.matricule', '=', $matricule)
            ->orderBy('facturesarticles.referenceF')
            ->get(['factures.*', 'facturesarticles.*','fournisseurs.*','articles.*']);
        }

        public function deleteReglement($referenceF){
            return Reglement::where('referenceF',$referenceF)->delete();
        }

        public function getCreditReglementFournisseur($matricule){
            $credits = $this->getAllInformationsReglements($matricule);
            $somme = 0;
            foreach ($credits as $value) {
                if (is_numeric($value->net) && is_numeric($value->paye)){
                    $somme += $value->net - $value->paye;
                }
            }
            return $somme;
        }

        public static function getCreditReglementListeFournisseur($matricule){
            $c =  new ReglementController();
            $credits = $c->getAllInformationsReglements($matricule);
            $somme = 0;
            foreach ($credits as $value) {
                if (is_numeric($value->net) && is_numeric($value->paye)){
                    $somme += $value->net - $value->paye;
                }
            }
            return $somme;
        }

        public function getSommeMontantPaye($matricule){
            $credits = $this->getAllInformationsReglements($matricule);
            $somme = 0;
            foreach ($credits as $value) {
                if (is_numeric($value->paye)){
                    $somme += $value->paye;
                }
            }
            return $somme;
        }

        public function getAllInformationsReglementsEdit($matricule){
            return Facture::join('reglements', 'reglements.referenceF', '=', 'factures.referenceF')
                ->where('factures.matricule', '=', $matricule)
                ->orderBy('reglements.date','desc')
                ->paginate(10,array('factures.*','reglements.*'));
        }

        public function openAddReglementLibre(Request $request){
            $informations = $this->getFactureController()->getInformationsUser();
            $nom = $this->getFournisseurController()->getInformationsFournisseurs($request->Input('matricule'))->getNomAttribute();
            $matricule = $request->Input('matricule');
            return view('reglement.add_reglement_libre',compact('informations','nom','matricule'));
        }

        public function gestionStoreReglementLibre(Request $request){
            if($this->storeReglementLibre($request->matricule,$request->paye,$request->nom,$request->date)){
                return back()->with('success', 'Le réglement libre a été ajouté avec succès.');
            }

            else{
                return back()->with('erreur', 'Pour des raisons techniques, il est impossible de modifier ce réglement.');
            }
        }

        public function storeReglementLibre($matricule,$paye,$nom,$date){
            $reglement = new Reglement();
            $reglement->setNetAttribute("0");
            $reglement->setPayeAttribute($paye);
            $reglement->setMatriculeAttribute($matricule);
            $reglement->setDateAttribute($date);
            $reglement->setReferenceFAttribute($nom."/Libre");
            return $reglement->save();
        }
    }
?>
