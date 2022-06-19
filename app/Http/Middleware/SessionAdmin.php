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
            if(Session()->has('username') && ((Session()->get('type') == "Administrateur") && ($request->url() == url('/add-client'))
            
            )){
                return view('errors.404');
            }
            return $next($request);
        }
}
