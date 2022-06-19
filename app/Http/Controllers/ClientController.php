<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;

    class ClientController extends Controller{
        public function getFactureController(){
            return new FactureController();
        }

        public function openAddClient(){
            $informations = $this->getFactureController()->getInformationsUser();
            return view('client.add_client',compact('informations'));
        }
    }
?>
