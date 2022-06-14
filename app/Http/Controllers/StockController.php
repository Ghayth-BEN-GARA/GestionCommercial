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
            $stocks->setPrixAttribute($prix);
            $stocks->setReferenceAttribute($reference);
            return $stocks->save();
        }

        public function updateStock($qte,$prix,$reference){
            $stock = Stock::where('reference', $reference)->first();
            return Stock::where('reference',$reference)->update([
                'qteStock' => $stock->getQteStockAttribute() + $qte,
                'prix'=> $prix
            ]);
        }

        public function updateStockWithoutPrix($qte,$reference){
            $stock = Stock::where('reference', $reference)->first();
            return Stock::where('reference',$reference)->update([
                'qteStock' => $stock->getQteStockAttribute() + $qte
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
                    'qteStock' => 0
                ]);
            }

            else{
                Stock::where('reference',$reference)->update([
                    'qteStock' => $stock->getQteStockAttribute() - $qte
                ]); 
            }
        }

        public function gestionDeleteStock($referenceF){
            $historiques = FactureArticle::where('referenceF', $referenceF)->get();
            foreach ($historiques as $row){
                $this->removeQuantite($row->reference,$row->qte);
            }
        }

        public function openListArticleDisponibleStock(){
            $informations = $this->getFactureController()->getInformationsUser();
            return view('stock.liste_article_disponible',compact('informations'));
        }

        public function getPrixAttribute($reference){
            return Stock::where('reference', $reference)->firstOrFail()->getPrixAttribute();
        }

        public function updatePrixStock($reference,$prix){
            return Stock::where('reference',$reference)->update([
                'prix' => $prix
            ]);
        }

        public function getArticleController(){
            return new ArticleController();
        }

        public function getValidationController(){
            return new ValidationController();
        }

        public function openDescriptionArticle(Request $request){
            try {
                $informations = $this->getFactureController()->getInformationsUser();
                $reference = $request->Input('reference');
                $descriptionArticle = $this->getArticleController()->getAllInformationsArticle($reference);
                $other = $this->getArticleController()->getOtherDescriptionArticle($reference);
                return view('stock.description_article',compact('informations','reference','descriptionArticle','other'));
            } catch (ModelNotFoundException $e) {
                return view('errors.404');
            }
        
        }

        public function gestionUpdatePrixStockInstantane(Request $request){
            if($this->updatePrixStock($request->reference,$request->prix)){
                if($this->getValidationController()->removeValidationPrix($request->reference)){
                    return true;
                }

                else{
                    return false;
                }
            }

            else{
                return false;
            }
        }

        public function openMeilleurPrixAchat(Request $request){
            $informations = $this->getFactureController()->getInformationsUser();
            $reference = $request->Input('reference');
            return view('stock.meilleur_prix',compact('informations','reference'));
        }
    }
?>
