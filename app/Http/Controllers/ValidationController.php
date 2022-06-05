<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Validation;

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
            return $validation->save();
        }
    }
