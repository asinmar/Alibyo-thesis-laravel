<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class VisitorAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user() && \Auth::user()->acc_position =='User')
        {
            return $next($request);
            
        }
        if(Auth::user() && \Auth::user()->acc_position !='User' )
        {
            
                return abort(403);
        }
        else
        {
            return redirect('/signin');
        }
        
    }
    
}
