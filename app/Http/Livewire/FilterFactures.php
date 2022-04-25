<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Facture;
    use App\Models\Fournisseur;  

    class FilterFactures extends Component{
        public $search;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.filter-factures', [
    		    'factures' =>Facture::join('fournisseurs', 'fournisseurs.matricule', '=', 'factures.matricule')
                ->where('factures.referenceF', 'like', '%'.$this->search.'%')
                ->orWhere('fournisseurs.nom', 'like', '%'.$this->search.'%')
                ->orWhere('fournisseurs.matricule', 'like', '%'.$this->search.'%')
                ->orderBy('factures.date', 'desc')
                ->paginate(10, array('factures.*', 'fournisseurs.*'))
    	    ]);
        }

        public function setPage($url){
            $this->currentPage = explode('page=',$url)[1];
            Paginator::currentPageResolver(function(){
                return $this->currentPage;
            });
        }
    }
?>
