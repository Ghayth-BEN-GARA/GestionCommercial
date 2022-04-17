<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;

    class UserController extends Controller{
        public function openSignIn(){
            return view('login');
        }
    }
?>
