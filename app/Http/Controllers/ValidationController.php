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
            return Validation::all();
        }

        public function storeValidation($prix, $reference){
            $validation = new Validation();
            $validation->setPrixAttribute($prix);
            $validation->setReferenceAttribute($reference);
            $validation->setDateCreationAttribute();
            return $validation->save();
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
