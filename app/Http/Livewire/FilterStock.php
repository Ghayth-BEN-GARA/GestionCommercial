<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Article; 
    use App\Models\Stock;  

    class FilterStock extends Component{
        public $search;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.filter-stock', [
    		    'stocks' =>Stock::join('articles', 'articles.reference', '=', 'stocks.reference')
                ->where('articles.designation', 'like', '%'.$this->search.'%')
                ->orWhere('stocks.reference', 'like', '%'.$this->search.'%')
                ->orderBy('articles.designation','asc')
                ->paginate(10, array('stocks.*', 'articles.*'))
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
