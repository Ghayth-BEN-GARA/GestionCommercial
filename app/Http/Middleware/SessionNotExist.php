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
                return view('errors.404');
            }

            else if(Session()->has('username') && (Session()->get('type') == "User") &&
            ($request->url() == url('/add-user') || ($request->url() == url('list-user')) ||
            ($request->url() == url('/user')) 
            )){
                return view('errors.500');
            }

            else if(Session()->has('username') && (Session()->get('type') == "Administrateur") && 
            (($request->url() == url('/profil')) || ($request->url() == url('/edit-image-profil')) ||
            ($request->url() == url('/edit-password-profil')) || ($request->url() == url('/edit-user'))
            )){
                return view('errors.500');
            }

            else if(Session()->has('username') && ((Session()->get('type') == "Administrateur") || (Session()->get('type') == "User")) &&
            (($request->url() == url('/add-fournisseur')) || ($request->url() == url('/list-fournisseur')) || ($request->url() == url('/edit-fournisseur')) ||
            ($request->url() == url('/fournisseur')) || ($request->url() == url('/others')) || ($request->url() == url('/add-achat'))
            )
                
            
            ){
                return view('errors.500');
            }
            return $next($request);
        }
    }
?>
