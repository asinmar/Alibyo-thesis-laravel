<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminAuth
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
        
        if((Auth::user() && \Auth::user()->acc_position =='Admin')&&(Auth::user() && \Auth::user()->acc_status =='Enabled'))
        {
            return $next($request);
            
        }
        if(Auth::user() && \Auth::user()->acc_position !='Admin')
        {
                return abort(403);
        
        }
        else
        {
            return redirect('/signin')->with('alert','Unable to access, account is currently on hold');
        }
    }
}
