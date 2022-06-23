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
                            <div class = "col-md-4 grid-margin stretch-card">
                                <div class = "card">
                                    <div class = "card-body">
                                        <h4 class = "card-title">Nom et prénom</h4>
                                        <div class = "media"> 
                                            <i class = "ti-user icon-md text-info d-flex align-self-start mr-3 mt-2"></i>
                                            <div class = "media-body">
                                                <p class = "card-text">{{$client->getFullnameAttribute()}}</p>
                                                <p>(Le nom complet du client)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-md-4 grid-margin stretch-card">
                                <div class = "card">
                                    <div class = "card-body">
                                        <h4 class = "card-title">Matricule</h4>
                                        <div class = "media"> 
                                            <i class = "ti-id-badge icon-md text-info d-flex align-self-start mr-3 mt-2"></i>
                                            <div class = "media-body">
                                                <p class = "card-text">{{$client->getMatriculeAttribute()}}</p>
                                                <p>(L'identifiant du client)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-md-4 grid-margin stretch-card">
                                <div class = "card">
                                    <div class = "card-body">
                                        <h4 class = "card-title">Adresse ou ville</h4>
                                        <div class = "media"> 
                                            <i class = "ti-home icon-md text-info d-flex align-self-start mr-3 mt-2"></i>
                                            <div class = "media-body">
                                                <p class = "card-text">{{$client->getAdresseAttribute()}}</p>
                                                <p>(L'adresse ou la ville du client)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-md-4 grid-margin stretch-card">
                                <div class = "card">
                                    <div class = "card-body">
                                        <h4 class = "card-title">Numéro mobile</h4>
                                        <div class = "media"> 
                                            <i class = "ti-mobile icon-md text-info d-flex align-self-start mr-3 mt-2"></i>
                                            <div class = "media-body">
                                                <p class = "card-text">{{$client->getTel1FormattedAttribute()}}</p>
                                                <p>(Le numéro obligatoire du client)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-md-4 grid-margin stretch-card">
                                <div class = "card">
                                    <div class = "card-body">
                                        <h4 class = "card-title">Numéro mobile</h4>
                                        <div class = "media"> 
                                            <i class = "ti-mobile icon-md text-info d-flex align-self-start mr-3 mt-2"></i>
                                            <div class = "media-body">
                                                <p class = "card-text">{{$client->getTel2FormattedAttribute()}}</p>
                                                <p>(Le numéro optionnel du client)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-md-4 grid-margin stretch-card">
                                <div class = "card">
                                    <div class = "card-body">
                                        <h4 class = "card-title">Adresse e-mail</h4>
                                        <div class = "media"> 
                                            <i class = "ti-email icon-md text-info d-flex align-self-start mr-3 mt-2"></i>
                                            <div class = "media-body">
                                                <p class = "card-text">{{$client->getEmailAttribute()}}</p>
                                                <p>(L'adresse e-mail du client)</p>
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