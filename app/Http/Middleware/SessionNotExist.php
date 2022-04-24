<?php
    namespace App\Http\Middleware;
    use Closure;
    use Illuminate\Http\Request;

    class SessionNotExist{
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
         * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
         */
        public function handle(Request $request, Closure $next){
            if(!Session()->has('username')){
                $lien = "/";
                $desc = "page d'authentification";
                return view('errors.404',compact('lien','desc'));
            }

            else if(Session()->has('username') && (Session()->get('type') == "User") &&
            ($request->url() == url('/add-user') || ($request->url() == url('list-user')) ||
            ($request->url() == url('/user')) 
            )){
                $lien = "home";
                $desc = "page d'accueil";
                return view('errors.500',compact('lien','desc'));
            }

            else if(Session()->has('username') && (Session()->get('type') == "Administrateur") && 
            (($request->url() == url('/profil')) || ($request->url() == url('/edit-image-profil')) ||
            ($request->url() == url('/edit-password-profil')) || ($request->url() == url('/edit-user'))
            )){
                $lien = "home";
                $desc = "page d'accueil";
                return view('errors.500',compact('lien','desc'));
            }

            else if(Session()->has('username') && ((Session()->get('type') == "Administrateur") || (Session()->get('type') == "User")) &&
            (($request->url() == url('/add-fournisseur')) || ($request->url() == url('/list-fournisseur')) || ($request->url() == url('/edit-fournisseur')) ||
            ($request->url() == url('/fournisseur')) || ($request->url() == url('/others')) || ($request->url() == url('/add-achat')) 
            )
                
            
            ){
                $lien = "home";
                $desc = "page d'accueil";
                return view('errors.500',compact('lien','desc'));
            }
            return $next($request);
        }
    }
?>
