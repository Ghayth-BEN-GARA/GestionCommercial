<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
    </head>
    <body>
        <div class = "container-scroller">
            @include ('layouts.horizontal_nav')
            <div class = "container-fluid page-body-wrapper">   
                @include ('layouts.vertical_nav')
                <div class = "main-panel">
                    <div class = "content-wrapper">
                        <div class = "row">
                            <div class = "col-md-12 grid-margin stretch-card">
                                <div class = "card">
                                    <div class = "card-body">
                                        <h4 class = "card-title">Historique</h4>
                                        <p class = "card-description">Consulter l'historique des prix d'achat</p>
                                        @livewire('filter-historique-prix-achat',['reference' => $reference])
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    @include ('layouts.footer')
                </div>
            </div>
        </div>
        @include ('layouts.script')
        @livewireScripts
    </body>
</html>