<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CityAdmin
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
        if(Auth::user() && \Auth::user()->acc_position =='City_Admin')
        {
            return $next($request);
            
        }
        if(Auth::user() && \Auth::user()->acc_position !='City_Admin' )
        {
            
                return abort(403);
        }
        else
        {
            return redirect('/signin');
        }
        
    }
}
