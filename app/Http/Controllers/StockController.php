<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Stock;
    use App\Models\FactureArticle;

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
                'qteStock' => $stock->getQteStockAttribute() + $qte,
                'qteTotale' => $stock->getQteTotaleAttribute() + $qte,
                'prix'=> $prix
            ]);
        }

        public function getFactureController(){
            return new FactureController();
        }

        public function openListStock(){
            $informations = $this->getFactureController()->getInformationsUser();
            return view('stock.liste_stock',compact('informations'));
        }

        public function removeQuantite($reference,$qte){
            $stock = Stock::where('reference', $reference)->first();
            if($stock->getQteStockAttribute() == 0){
                Stock::where('reference',$reference)->update([
                    'qteStock' => 0,
                    'qteTotale' => $stock->getQteTotaleAttribute() - $qte
                ]);
            }

            else if($stock->getQteTotaleAttribute() == 0){
                Stock::where('reference',$reference)->update([
                    'qteStock' => $stock->getQteStockAttribute() - $qte,
                    'qteTotale' => 0
                ]);
            }

            else{
                Stock::where('reference',$reference)->update([
                    'qteStock' => $stock->getQteStockAttribute() - $qte,
                    'qteTotale' => $stock->getQteTotaleAttribute() - $qte
                ]); 
            }
        }

        public function gestionDeleteStock($referenceF){
            $historiques = FactureArticle::where('referenceF', $referenceF)->get();
            foreach ($historiques as $row){
                $this->removeQuantite($row->reference,$row->qte);
            }
        }
    }
?>