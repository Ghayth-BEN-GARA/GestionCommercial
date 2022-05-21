<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Reglement;
    use App\Models\Facture;
    use App\Models\Fournisseur;

    class ReglementController extends Controller{
        public function creerReglement($net,$paye,$reference){
            $reglement = new Reglement();
            $reglement->setNetAttribute($net);
            $reglement->setPayeAttribute($paye);
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
                $sommeAPaye = $sommeAPaye + $value->getNetAttribute();
                $sommePaye = $sommePaye + $value->getPayeAttribute();
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

        public function openReglement($matricule){
            $informations = $this->getFactureController()->getInformationsUser();
            $reglements = $this->getInformationsReglements($matricule);
            $listeReglements = $this->getAllInformationsReglements($matricule);
            $fournisseur = $this->getFournisseurController()->getInformationsFournisseurs($matricule);
            return view('reglement.reglement',compact('informations','reglements','listeReglements','fournisseur','matricule'));
        }

        public function getFournisseurController(){
            return new FournisseurController();
        }

        public function getInformationsReglements($matricule){
            return [
                'nom' => $this->getFournisseurController()->getInformationsFournisseurs($matricule)->getNomAttribute(),
                'lastData' => $this->getFactureController()->getLastDate($matricule)->getDateAttribute(),
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
            return Facture::join('reglements', 'reglements.referenceF', '=', 'factures.referenceF')
                ->where('factures.matricule', '=', $matricule)
                ->orderBy('date','desc')
                ->paginate(10,array('factures.*','reglements.*'));
        }

        public static function getCreditReglement($net,$paye){
            $fact = new FactureController;

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

        public function openEditReglement($matricule){
            $informations = $this->getFactureController()->getInformationsUser();
            $listeReglements = $this->getAllInformationsReglements($matricule);
            
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
    }
?>
