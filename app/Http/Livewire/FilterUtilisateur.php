<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use Session;
    use App\Models\Personne; 
    use App\Models\Compte; 
    use App\Models\Image; 

    class FilterUtilisateur extends Component{
        public $search;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.filter-utilisateur', [
    		    'users' =>Compte::join('personnes', 'personnes.cin', '=', 'comptes.cin')
                ->join('images','images.cin','=','comptes.cin')
                ->where('personnes.prenom', 'like', '%'.$this->search.'%')
                ->where([
                    ['comptes.cin', '<>', $this->getUsernameSessionActive()],
                    ['comptes.type', 'LIKE', 'Utilisateur']
                ])
                ->orderBy('personnes.prenom', 'asc')
                ->paginate(10, array('comptes.*', 'personnes.*','images.*'))
    	    ]);
        }

        public function setPage($url){
            $this->currentPage = explode('page=',$url)[1];
            Paginator::currentPageResolver(function(){
                return $this->currentPage;
            });
        }

        public function getUsernameSessionActive(){
            return (Session::get('username')); 
        }
    }
?>
