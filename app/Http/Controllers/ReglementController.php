<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Reglement;

    class ReglementController extends Controller{
        public function creerReglement($net,$paye,$date,$reference){
            $reglement = new Reglement();
            $reglement->setNetAttribute($net);
            $reglement->setPayeAttribute($paye);
            $reglement->setDateAttribute($date);
            $reglement->setReferenceFAttribute($reference);
            return $reglement->save();
        }

        public function updateReglement($net,$reference){
            return Reglement::where('referenceF',$reference)->update([
                'net'=>$net
            ]);
        }
    }
?>
