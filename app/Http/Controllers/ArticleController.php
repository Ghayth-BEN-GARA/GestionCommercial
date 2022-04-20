<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Article;

    class ArticleController extends Controller{
        public function storeArticle(Request $request){
            if($this->verifyArticle($request->reference)){
                if($this->creerArticle($request->reference,$request->designation,$request->categorie)){
                    return back()->with('success', 'Une nouvel article a été créé avec succès.');
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
    }
?>
