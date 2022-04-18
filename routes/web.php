<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;
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
?>
