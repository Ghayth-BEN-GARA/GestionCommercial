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
                $ch = "Le fournisseur doit payer ".$this->stylingCredit($sommePaye - $sommeAPaye)." pour vous.";
            }

            else if($montant > 0){
                $ch = "Vous devez payer ".$this->stylingCredit($sommeAPaye - $sommePaye)." pour ce fournisseur.";
            }

            else{
                $ch = "Aucun crédit trouvé avec ce fournisseur.";
            }
            return $ch;
        }
    }
?>
