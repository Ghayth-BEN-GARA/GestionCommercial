<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Facture;
    use App\Models\Fournisseur;  
    use App\Models\FactureArticle;

    class FilterReglement extends Component{
        public $search;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.filter-reglement', [
    		    'reglements' =>Facture::join('fournisseurs', 'fournisseurs.matricule', '=', 'factures.matricule')
                ->join('reglements','factures.referenceF','=','reglements.referenceF')
                ->where('factures.referenceF', 'like', '%'.$this->search.'%')
                ->orWhere('fournisseurs.nom', 'like', '%'.$this->search.'%')
                ->orWhere('fournisseurs.matricule', 'like', '%'.$this->search.'%')
                ->orderBy('fournisseurs.nom','asc')
                ->groupBy('fournisseurs.matricule')
                ->paginate(10, array('factures.*', 'fournisseurs.*','reglements.*'))
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
