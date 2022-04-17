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
                            <div class = "col-md-12 grid-margin">
                                <div class = "row">
                                    <div class = "col-12 col-xl-8 mb-4 mb-xl-0">
                                        <h3 class = "font-weight-bold">Bienvenue {{$informations['fullname']}}</h3>
                                        <h6 class = "font-weight-normal mb-0">Tous les systèmes fonctionnent correctement !</span></h6>
                                    </div>
                                    <div class = "col-12 col-xl-4">
                                        <div class = "justify-content-end d-flex">
                                            <div class = "dropdown flex-md-grow-1 flex-xl-grow-0">
                                                <button class = "btn btn-sm btn-light bg-white" type = "button" id = "currentdate" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "true">
                                                    <i class = "mdi"></i> Aujourd'hui {{date('D d F Y',strtotime(date('D F Y')))}}
                                                </button>
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