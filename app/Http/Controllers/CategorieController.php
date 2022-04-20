<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Categorie;

    class CategorieController extends Controller{
        public function getUserController(){
            return new UserController();
        }

        public function getInformationsUser(){
            return $this->getUserController()->getInformationSessionActive($this->getUserController()->getTypeSessionActive());
        }

        public function openOthers(){
            $informations = $this->getInformationsUser();
            $categories = $this->getAllCategorie();
            return view('achat.others',compact('informations','categories'));
        }

        public function storeCategorie(Request $request){
            if($this->verifyCategorie($request->nom)){
                if($this->creerCategorie($request->nom)){
                    return back()->with('success', 'Une nouvelle catégorie a été créé avec succès.');
                }

                else{
                    return back()->with('erreur', 'Pour des raisons techniques, il est impossible de créer une nouvelle catégorie.');
                }
            }

            else{
                return back()->with('erreur', 'Une autre catégorie est déjà créée avec ce nom.');
            }
        }

        public function verifyCategorie($nom){
            return Categorie::where('nom', $nom)->get()->isEmpty();
        }

        public function creerCategorie($nom){
            $categorie = new Categorie();
            $categorie->setNomAttribute($nom);
            return $categorie->save();
        }

        public function getAllCategorie(){
            return Categorie::all()->sortBy('nom');
        }
    }
?>
