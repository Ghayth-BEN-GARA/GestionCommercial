<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Validation;
    use App\Models\Article;
    use DateTime;

    class ValidationController extends Controller{
        public static function  getCountValidation(){
            return Validation::count();
        }

        public static function  getAllValidation(){
            return Validation::join('articles', 'articles.reference', '=', 'validations.reference')
            ->orderBy('date_creation','desc')
            ->get(['validations.*', 'articles.*']);
        }

        public function verifyArticle($reference){
            return Validation::where('reference', $reference)->get()->isEmpty();
        }

        public function gestionStoreValidation($prix,$reference){
            if($this->verifyArticle($reference)){
                $this->storeValidation($prix,$reference);
            }

            else{
                $this->updateValidation($prix,$reference);
            }
        }

        public function storeValidation($prix,$reference){
            $validation = new Validation();
            $validation->setPrixAttribute($prix);
            $validation->setReferenceAttribute($reference);
            $validation->setDateCreationAttribute();
            return $validation->save();
        }

        public function updateValidation($prix,$reference){
            return Validation::where('reference',$reference)->update([
                'prix' => $prix,
                'date_creation' => date('Y/m/d')
            ]);
        }

        public static function getDifferenceBetweenDates($date){
            $current = date('Y/m/d');
            $first_datetime = new DateTime($date);
            $last_datetime = new DateTime($current);
            $interval = $first_datetime->diff($last_datetime);
            $final_days = $interval->format('%a');
            if($final_days == 0){
                return "Aujourd'hui.";
            }

            else{
                return "Il y a ".$final_days." jours.";
            }
        }

        public function getFactureController(){
            return new FactureController();
        }

        public function openValidationArticle(Request $request){
            try {
                $informations = $this->getFactureController()->getInformationsUser();
                $validations = $this->getValidationInformations($request->Input('reference'));
                $prixActuel = $this->getStockController()->getPrixAttribute($request->Input('reference'));
                $reference = $request->Input('reference');
                return view('stock.validation_article',compact('informations','validations','prixActuel','reference'));
            } catch (ModelNotFoundException $e) {
                return view('errors.404');
            }
           
        }

        public function getValidationInformations($reference){
            return Validation::join('articles', 'articles.reference', '=', 'validations.reference')
            ->where('validations.reference','=',$reference)
            ->firstOrFail(['articles.*','validations.*']);
        }

        public function getStockController(){
            return new StockController();
        }

        public function gestionValidationPrix(Request $request){
            if($this->getStockController()->updatePrixStock($request->reference,$request->prix)){
                $this->removeValidationPrix($request->reference);
                return redirect()->route('open-stock')->with('success', "Vous avez bien validé le nouveau prix d'achat de l'article.");
            }

            else{
                return back()->with('erreur', "Pour des raisons techniques, il est impossible de valider le nouveau prix d'achat.");
            }
        }

        public function removeValidationPrix($reference){
            return Validation::where('reference',$reference)->delete();
        }
    }
?>
