<div class = "division">
    @if ($paginator->hasPages())
        @if ($paginator->onFirstPage())
            <a href = "javascript:void(0)" class = "pred disabled">Précédent</a>      
        @else
            <a href = "#"  wire:click = "setPage('{{ $paginator->previousPageUrl() }}')" class = "pred">Précédent</a>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <a href = "javascript:void(0)" class = "disabled">{{$element}}</a>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href = "#" wire:click = "setPage('{{ $url }}')" class = "active">{{$page}}</a>
                    @else
                        <a href = "#" wire:click = "setPage('{{ $url }}')" class = "pg">{{$page}}</a>
                    @endif 
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <a href = "#" wire:click = "setPage('{{ $paginator->nextPageUrl() }}')" class = "next">Suivant</a>
        @else
            <a href = "javascript:void(0)" class = "next disabled">Suivant</a>
        @endif
    @endif
</div>

