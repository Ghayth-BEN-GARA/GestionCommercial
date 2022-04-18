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
            ($request->url() == url('/add-user'))){
                return view('errors.500');
            }

            else if(Session()->has('username') && (Session()->get('type') == "Administrateur") && 
            ($request->url() == url('/profil'))){
                return view('errors.500');
            }
            return $next($request);
        }
    }
?>
