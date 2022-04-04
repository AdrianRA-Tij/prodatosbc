<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class esSujeto
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      $user = Auth::user();
      if (Auth::check() && !$user->esSujeto()  &&  Auth::user()->rol_id == '1') {
          return redirect('/usuarios');
      }elseif(Auth::check()  && $user->esSujeto() &&  Auth::user()->rol_id == '2'){

          return $next($request);
      }

      else{
          return redirect('/');
      }
    }
}
