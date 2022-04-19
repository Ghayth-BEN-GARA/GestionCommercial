<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;

    class FournisseurController extends Controller{
        public function openAddFournisseur(){
            $informations = $this->getInformationsUser();
            return view('fournisseur.add_fournisseur',compact('informations'));
        }

        public function getUserController(){
            return new UserController();
        }

        public function getInformationsUser(){
            return $this->getUserController()->getInformationSessionActive($this->getUserController()->getTypeSessionActive());
        }
    }
