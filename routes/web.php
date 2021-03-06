<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\FournisseurController;
    use App\Http\Controllers\CategorieController;
    use App\Http\Controllers\ArticleController;
    use App\Http\Controllers\FactureController;
    use App\Http\Controllers\ReglementController;
    use App\Http\Controllers\StockController;
    use App\Http\Controllers\ValidationController;
    use App\Http\Controllers\ClientController;
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/', [UserController::class, 'openSignIn'])->middleware('session')->name('login');
    Route::post('/signin', [UserController::class, 'loginCompte']);
    Route::get('/home', [UserController::class, 'openHome'])->middleware('notsession')->name('home');
    Route::get('/logout', [UserController::class, 'logoutCompte']);
    Route::get('/add-user', [UserController::class, 'openAddCompte'])->middleware('notsession');
    Route::get('/verify-cin-user', [UserController::class, 'verifyCompte']);
    Route::post('/add-personne', [UserController::class, 'storeCompte']);
    Route::get('/profil', [UserController::class, 'openProfil'])->middleware('notsession');
    Route::get('/edit-image-profil', [UserController::class, 'openEditImageProfil'])->middleware('notsession');
    Route::get('/delete-image', [UserController::class, 'deleteImage']);
    Route::post('/update-image', [UserController::class, 'updateImage']);
    Route::post('/update-password', [UserController::class, 'updatePassword']);
    Route::post('/update-user', [UserController::class, 'updateUser']);
    Route::get('/delete-user', [UserController::class, 'gestionDeleteUser']);
    Route::get('/list-user', [UserController::class, 'openListUser'])->middleware('notsession');
    Route::get('/delete-utilisateur/{cin}', [UserController::class, 'gestionDeleteUtilisateur']);
    Route::get('/user/{cin}', [UserController::class, 'openProfilUser'])->middleware('notsession')->name('user-search');
    Route::get('/add-fournisseur', [FournisseurController::class, 'openAddFournisseur'])->middleware('notsession');
    Route::get('/verify-matricule', [FournisseurController::class, 'verifyMatriculeFournisseur']);
    Route::post('/creer-fournisseur', [FournisseurController::class, 'storePersonne']);
    Route::get('/list-fournisseur', [FournisseurController::class, 'openListFournisseur'])->middleware('notsession');
    Route::get('/edit-fournisseur', [FournisseurController::class, 'openEditFournisseur'])->middleware('notsession')->name('fournisseur-edit');
    Route::post('/update-fournisseur', [FournisseurController::class, 'gestionUpdateFournisseur']);
    Route::get('/fournisseur', [FournisseurController::class, 'openFournisseur'])->middleware('notsession')->name('fournisseur');
    Route::get('/others', [CategorieController::class, 'openOthers'])->middleware('notsession');
    Route::post('/add-categorie', [CategorieController::class, 'storeCategorie']);
    Route::get('/add-article', [ArticleController::class, 'storeArticle']);
    Route::get('/add-achat', [FactureController::class, 'openAddFacture'])->middleware('notsession');
    Route::get('/get-matricule-fournisseur', [FournisseurController::class, 'getMatriculeFournisseur']);
    Route::get('/verify-reference-facture', [FactureController::class, 'verifyReferenceFacture']);
    Route::post('/add-facture', [FactureController::class, 'gestionStoreFacture']);
    Route::get('/autocomplete-reference-facture', [FactureController::class, 'getReferenceFactureSearch']);
    Route::get('/autocomplete-designation-facture', [ArticleController::class, 'getDesignationFactureSearch']);
    Route::get('/autocomplete-reference-facture', [ArticleController::class, 'getReferenceFactureSearch']);
    Route::get('/autocomplete-categorie-facture', [CategorieController::class, 'getCategorieFactureSearch']);
    Route::get('/get-data-article', [ArticleController::class, 'getInformationsArticle']);
    Route::post('/add-article-achat', [ArticleController::class, 'storeArticleToFacture']);
    Route::get('/list-achat', [FactureController::class, 'openListAchat'])->middleware('notsession');
    Route::get('/delete-facture', [FactureController::class, 'gestionDeleteFacture']);
    Route::get('/facture', [FactureController::class, 'openAchat'])->middleware('notsession')->name('consult-achat');
    Route::get('/list-reglement', [ReglementController::class, 'openListReglement'])->middleware('notsession');
    Route::get('/reglement', [ReglementController::class, 'openReglement'])->middleware('notsession')->name('consult-reglement');
    Route::get('/list-stock', [StockController::class, 'openListStock'])->middleware('notsession')->name('open-stock');
    Route::get('/article-disponible', [StockController::class, 'openListArticleDisponibleStock'])->middleware('notsession');
    Route::get('/edit-reglement', [ReglementController::class, 'openEditReglement'])->middleware('notsession')->name('reglement-edit');
    Route::post('/edit-paye-reglement', [ReglementController::class, 'gestionEditReglement']);
    Route::get('/facture-reglement', [ReglementController::class, 'openFactureReglement'])->middleware('notsession')->name('reglement-facture-consult');
    Route::get('/verify-reference-facture-add', [FactureController::class, 'verifyReferenceAddFacture']);
    Route::get('/validation-article', [ValidationController::class, 'openValidationArticle'])->middleware('notsession');
    Route::post('/valider-prix', [ValidationController::class, 'gestionValidationPrix']);
    Route::get('/description-article', [StockController::class, 'openDescriptionArticle'])->middleware('notsession');
    Route::post('/update-marge', [ArticleController::class, 'gestionUpdateMargePrix']);
    Route::get('/add-reglement-libre', [ReglementController::class, 'openAddReglementLibre'])->middleware('notsession');
    Route::post('/store-reglement-libre', [ReglementController::class, 'gestionStoreReglementLibre']);
    Route::get('/historique-prix-achat', [FactureController::class, 'openHistoriquePrixAchat'])->middleware('notsession');
    Route::get('/all-notifications', [ValidationController::class, 'openShowAllNotifications'])->middleware('notsession');
    Route::get('/set-new-prix-achat', [StockController::class, 'gestionUpdatePrixStockInstantane']);
    Route::get('/meilleur-prix-achat', [StockController::class, 'openMeilleurPrixAchat'])->middleware('notsession');
    Route::get('/get-liste-meilleur-prix', [FactureController::class, 'meilleurPrixParFournisseur']);
    Route::post('/update-prix-stock', [StockController::class, 'gestionUpdatePrixStock']);
    Route::get('/add-client', [ClientController::class, 'openAddClient'])->middleware('sessionadministrateur');
    Route::get('/verify-matricule-cin', [ClientController::class, 'verifyMatriculeCinClient']);
    Route::post('/creer-client', [ClientController::class, 'gestionCreerClient']);
    Route::get('/list-clients', [ClientController::class, 'openListClients'])->middleware('sessionadministrateur');
    Route::get('/client', [ClientController::class, 'openClient'])->middleware('sessionadministrateur')->name('client');
    Route::get('/edit-client', [ClientController::class, 'openEditClient'])->middleware('sessionadministrateur')->name('client-edit');
    Route::post('/update-client', [ClientController::class, 'gestionUpdateClient']);




?>

