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
    }
?>
