<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Reglement;

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
            return view('reglement.reglement',compact('informations','reglements'));
        }

        public function getFournisseurController(){
            return new FournisseurController();
        }

        public function getInformationsReglements($matricule){
            return [
                'nom' => $this->getFournisseurController()->getInformationsFournisseurs($matricule)->getNomAttribute(),

            ];
        }
    }
?>
