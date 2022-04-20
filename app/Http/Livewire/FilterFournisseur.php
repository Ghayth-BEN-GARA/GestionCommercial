<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Fournisseur; 

    class FilterFournisseur extends Component{
	    public $search;
        public $currentPage = 1;
        use WithPagination;
        
        public function render(){
            return view('livewire.filter-fournisseur', [
    		    'fournisseur' =>	Fournisseur::where(function($sub_query){
    							$sub_query->where('nom', 'like', '%'.$this->search.'%')
                                ->orWhere('matricule', 'like', '%'.$this->search.'%');
    						})->paginate(10)
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
