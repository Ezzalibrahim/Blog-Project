<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class checkCategory
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
        if (Category::all()->count() == 0) {
            session()->flash('error', 'Pleas add some Categories');
            return redirect(route('categorie.index'));
        }
        return $next($request);
    }
}
