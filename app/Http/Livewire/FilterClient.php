<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Client; 

    class FilterClient extends Component{
        public $search;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.filter-client', [
    		    'clients' => Client::where('fullname', 'like', '%'.$this->search.'%')
                                ->orWhere('matricule', 'like', '%'.$this->search.'%')
                                ->orWhere('email', 'like', '%'.$this->search.'%')
                                ->orderBy('fullname', 'asc')
                                ->paginate(10)
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
