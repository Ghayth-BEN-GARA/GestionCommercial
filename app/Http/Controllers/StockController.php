<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Stock;

    class StockController extends Controller{
        public function verifyStock($reference){
            return Stock::where('reference', $reference)->get()->isEmpty();
        }

        public function creerStock($qte,$prix,$reference){
            $stocks = new Stock();
            $stocks->setQteStockAttribute($qte);
            $stocks->setQteTotaleAttribute($qte);
            $stocks->setPrixAttribute($prix);
            $stocks->setReferenceAttribute($reference);
            $stocks->save();
        }

        public function updateStock($qte,$prix,$reference){
            $stock = Stock::where('reference', $reference)->first();
            Stock::where('reference',$reference)->update([
                'qteStock' => $qte,
                'qteTotale' => $stock->getQteTotaleAttribute() + $qte,
                'prix'=> $prix
            ]);
        }
    }
?>
