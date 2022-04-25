<!DOCTYPE html>
<html lang = "en">
    <head>
        @include ('layouts.head')
        <link rel = "stylesheet" href = "{{asset('css/reglement.css')}}">
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
                                        <div class = "my-5 page">
                                            <div class = "p-5">
                                                <section class = "top-content bb d-flex justify-content-between">
                                                    <div class = "logo">
                                                        <h3>{{$reglements['nom']}}</h3>
                                                    </div>
                                                </section>
                                                <section class = "store-user mt-5">
                                                    <div class = "col-12">
                                                        <p class = "adress">Risque des clients aux : {{$reglements['dateAu']}}</p>
                                                        <br>
                                                        <div class = "date">
                                                            <span class = "de">Du : </span>
                                                            <span>{{$reglements['dateDu']}}</span>
                                                            <span class = "de"> Au : </span>
                                                            <span>{{$reglements['dateAu']}}</span>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
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
    </body>
</html>