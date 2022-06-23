<?php
    namespace App\Http\Middleware;
    use Closure;
    use Illuminate\Http\Request;

    class SessionAdmin{
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
         * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
         */
        public function handle(Request $request, Closure $next){
            if(Session()->has('username') && ((Session()->get('type') == "Administrateur") && (($request->url() == url('/add-client')) ||
                ($request->url() == url('/list-clients')) || ($request->url() == url('/client')) || ($request->url() == url('/edit-client'))
            
            
            ))){
                return view('errors.404');
            }
            return $next($request);
        }
}
