<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Facture;
    use App\Models\Fournisseur;  
    use App\Models\FactureArticle;
    use App\Models\Article;

    class FilterHistoriquePrixAchat extends Component{
        public $search;
        public $reference;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.filter-historique-prix-achat', [
    		    'historiques' =>FactureArticle::join('factures', 'factures.referenceF', '=', 'facturesarticles.referenceF')
                ->join('articles','facturesarticles.reference','=','articles.reference')
                ->join('fournisseurs','factures.matricule','=','fournisseurs.matricule')
                ->where('facturesarticles.reference','like',$this->reference)
                ->where('fournisseurs.nom', 'like', '%'.$this->search.'%')
                ->orderBy('fournisseurs.nom','asc')
                ->paginate(10, array('factures.*', 'fournisseurs.*','facturesarticles.*','articles.*'))
    	    ]);
        }
    }
?>
