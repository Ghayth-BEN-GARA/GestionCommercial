<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Client;

    class ClientController extends Controller{
        public function getFactureController(){
            return new FactureController();
        }

        public function openAddClient(){
            $informations = $this->getFactureController()->getInformationsUser();
            return view('client.add_client',compact('informations'));
        }

        public function verifyMatriculeCinClient(Request $request){
            return Client::where('matricule', $request->matricule)->get()->isEmpty();
        }

        public function gestionCreerClient(Request $request){
            if($this->creerClient($request->matricule,$request->fullname,$request->email,$request->adresse,$request->tel1,$request->tel2)){
                return back()->with('success', 'Un nouveau client a été créé avec succès.');
            }

            else{
                return back()->with('erreur', 'Pour des raisons techniques, il est impossible de créer un nouveau client.');
            }
        }

        public function creerClient($matricule,$fullname,$email,$adresse,$tel1,$tel2){
            $client = new Client();
            $client->setMatriculeAttribute($matricule);
            $client->setFullnameAttribute($fullname);
            $client->setEmailAttribute($email);
            $client->setAdresseAttribute($adresse);
            $client->setTel1Attribute($tel1);
            if($tel2 == null){
                $client->setTel2Attribute("0");
            }

            else{
                $client->setTel2Attribute($tel2);
            }
            return $client->save();
        }

        public function openListClients(){
            $informations = $this->getFactureController()->getInformationsUser();
            return view('client.liste_client',compact('informations'));
        }

        public function openClient(Request $request){
            $informations = $this->getFactureController()->getInformationsUser();
            $client = $this->getInformationsClient($request->Input('matricule'));
            return view('client.client',compact('informations','client'));
        }

        public function getInformationsClient($matricule){
            return Client::where('matricule',$matricule)->first();
        }

        public function openEditClient(Request $request){
            $informations = $this->getFactureController()->getInformationsUser();
            $client = $this->getInformationsClient($request->Input('matricule'));
            return view('client.edit_client',compact('informations','client'));
        }

        public function gestionUpdateClient(Request $request){
            if(!$this->updateClient($request->matricule,$request->nom,$request->email,$request->adresse,$request->tel1,$request->tel2)){
                return back()->with('erreur', 'Pour des raisons techniques, il est impossible de modifier ce client.');
            }

            else{
                return back()->with('success', 'Le client a été modifié avec succès.');
            }
        }

        public function updateClient($matricule,$nom,$email,$adresse,$tel1,$tel2){
            return Client::where('matricule',$matricule)->update([
                'fullname' => $nom,
                'email' => $email,
                'adresse' => $adresse,
                'tel1' => $tel1,
                'tel2' => $tel2,
            ]);
        }
    }
?>
