<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Article;
    use App\Models\Categorie;
    use App\Models\Reglement;
    use App\Models\FactureArticle;

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
                $data[] = $art->getDesignationAttribute().""; 
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
                $data[] = $art->getReferenceAttribute().""; 
            }
            echo json_encode($data);
        }

        public function getReglementController(){
            return new ReglementController();
        }

        public function getCategorieController(){
            return new CategorieController();
        }

        public function storeArticleToFacture(Request $request){
            $somme = 0;
            $paye = 0;

            $designation = $request->designation;
            $reference = $request->reference;
            $categorie = $request->categorie;
            $quantite = $request->quantite;
            $prix = $request->prix;
            
            foreach($request->designation as $key => $insert){
                if(!$this->verifyArticle($reference[$key])){
                    $enregistrementListeArticles = [
                        'reference' => $reference[$key],
                        'referenceF' => $request->referenceF,
                        'qte' => $quantite[$key],
                        'prixU' => $prix[$key]
                    ];
                    FactureArticle::insert($enregistrementListeArticles);
                    $somme += $somme + ($quantite[$key] * $prix[$key]);
                }
            }
            $this->getReglementController()->creerReglement($somme,$this->verifierEtatPayement($paye,$somme),$request->referenceF);
            return back()->with('success', 'Une nouvelle facture a été créé avec succès.');            
        }

        public function verifierEtatPayement($paiement,$somme){
            if($paiement == ''){
                return $somme;
            }

            else{
                return $paiement;
            }
        }
    }
?>
