<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Validation;
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
    }
