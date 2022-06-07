<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Article;
    use App\Models\Categorie;
    use App\Models\Reglement;
    use App\Models\FactureArticle;
    use App\Models\Stock;
    use App\Models\Facture;

    class ArticleController extends Controller{
        public function storeArticle(Request $request){
            if($this->verifyArticle($request->reference)){
                if($this->creerArticle($request->reference,$request->designation,$request->categorie)){
                    return back()->with('success', 'Un nouvel article a été créé avec succès.');
                }

                else{
                    return back()->with('erreur', 'Pour des raisons techniques, il est impossible de créer un nouvel article.');
                }
            }

            else{
                return back()->with('erreur', 'Un autre article est déjà créée avec cette référence.');
            }
        }

        public function verifyArticle($reference){
            return Article::where('reference', $reference)->get()->isEmpty();
        }

        public function creerArticle($reference,$designation,$categorie){
            $article = new Article();
            $article->setReferenceAttribute($reference);
            $article->setDesignationAttribute($designation);
            $article->setCategorieAttribute($categorie);
            return $article->save();
        }

        public function getDesignationFactureSearch(Request $request){
            if($request->get('query') != ''){
                $article = Article::where('designation', 'LIKE', '%'.$request->get('query').'%')->get();
            }
            
            $data = array();
            foreach ($article as $art){
                $data[] = $art->getDesignationAttribute(); 
            }
            echo json_encode($data);
        }

        public function getInformationsArticle(Request $request){
            $article = Article::where('designation', 'LIKE', $request->designation)->first();
            $data = array(
                'designation' => $article->getDesignationAttribute(),
                'reference' => $article->getReferenceAttribute(),
                'categorie' => $article->getCategorieAttribute()
            );

            echo json_encode($data);
        }

        public function getReferenceFactureSearch(Request $request){
            if($request->get('query') != ''){
                $article = Article::where('reference', 'LIKE', '%'.$request->get('query').'%')->get();
            }
            
            $data = array();
            foreach ($article as $art){
                $data[] = $art->getReferenceAttribute().''; 
            }
            echo json_encode($data);
        }

        public function getReglementController(){
            return new ReglementController();
        }

        public function getCategorieController(){
            return new CategorieController();
        }

        public function getStockController(){
            return new StockController();
        }

        public function getValidationController(){
            return new ValidationController();
        }

        public function storeArticleToFacture($request){
            $paye = 0;
            $somme = 0;

            $designation = $request->designation;
            $reference = $request->reference;
            $categorie = $request->categorie;
            $quantite = $request->quantite;
            $prix = $request->prix;
            
            foreach($request->designation as $key => $insert){
                if($this->verifyArticle($reference[$key])){
                    $enregistrementArticle = [
                        'designation' => $designation[$key],
                        'reference' => $reference[$key],
                        'categorie' => $categorie[$key]
                    ];
                    Article::insert([$enregistrementArticle]);
                }
                $enregistrementListeArticles = [
                    'reference' => $reference[$key],
                    'referenceF' => $request->nom.'/'.$request->referenceF,
                    'qte' => $quantite[$key],
                    'prixU' => $prix[$key]
                ];
                FactureArticle::insert([$enregistrementListeArticles]);  
                
                $somme += ($prix[$key] * $quantite[$key]);

                if($this->getStockController()->verifyStock($reference[$key])){
                    $this->getStockController()->creerStock($quantite[$key],$prix[$key],$reference[$key]);
                }

                else{
                    if($prix[$key] == $this->getStockController()->getPrixAttribute($reference)){
                        $this->getStockController()->updateStock($quantite[$key],$prix[$key],$reference[$key]);
                    }
                    
                    else{
                        $this->getValidationController()->gestionStoreValidation($prix[$key],$reference[$key]);
                        $this->getStockController()->updateStockWithoutPrix($quantite[$key],$reference[$key]);
                    }
                }
            }

            if($request->paye == null){
                $paye = $somme;
            }

            else{
                $paye = $request->paye;
            }

            if($this->getReglementController()->creerReglement($somme,$this->verifierEtatPayement($paye,$somme),$request->nom.'/'.$request->referenceF, $request->matricule,$request->date)){
                return true;
            }

            else{
                return false;
            }
        }

        public function verifierEtatPayement($paiement,$somme){
            if($paiement == ''){
                return $somme;
            }

            else{
                return $paiement;
            }
        }

        public function getAllInformationsArticle($reference){
            return Article::join('stocks', 'articles.reference', '=', 'stocks.reference')
            ->join('facturesarticles','articles.reference','=','facturesarticles.reference')
            ->where('articles.reference','=',$reference)
            ->firstOrFail(['articles.*','stocks.*','facturesarticles.*']);
        }

        public function getOtherDescriptionArticle($reference){
            return Facture::join('facturesarticles', 'facturesarticles.referenceF', '=', 'factures.referenceF')
            ->join('fournisseurs','fournisseurs.matricule','=','factures.matricule')
            ->where('facturesarticles.reference','=',$reference)
            ->groupBy('fournisseurs.matricule')
            ->orderBy('facturesarticles.id','desc')
            ->get(['facturesarticles.*','factures.*','fournisseurs.*']);
        }

        public static function calculeMargePrix($reference){
            $article = Stock::where('reference', $reference)->first();
            $marge = ($article->getPrixAttribute() * $article->getMargeAttribute()) / 100;
            return ($article->getPrixAttribute() + $marge);
        }

        public function gestionUpdateMargePrix(Request $request){
            if($this->updateMarge($request->reference,$request->marge)){
                return redirect()->route('open-stock')->with('success','Le marge de prix souhaitée a été mise à jour avec succès.');
            }

            else{
                return redirect()->route('open-stock')->with('erreur',"Pour des raisons techniques, la marge de prix souhaitée n'a pas été mise à jour.");
            }
        }

        public function updateMarge($reference,$marge){
            return Stock::where('reference',$reference)->update([
                'marge' => $marge
            ]);
        }
    }
?>
