<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;

    class FactureController extends Controller{
        public function getUserController(){
            return new UserController();
        }

        public function getInformationsUser(){
            return $this->getUserController()->getInformationSessionActive($this->getUserController()->getTypeSessionActive());
        }

        public function getFournisseurController(){
            return new FournisseurController();
        }

        public function getInformationsFournisseurs(){
            return $this->getFournisseurController()->getAllFournisseur();
        }

        public function openAddFacture(){
            $informations = $this->getInformationsUser();
            $fournisseurs = $this->getInformationsFournisseurs();
            return view('achat.add_achat',compact('informations','fournisseurs'));
        }
    }
?>
