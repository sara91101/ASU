<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class WebsiteVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // echo  is_null($request->server('HTTP_REFERER'))."<br>".$request->server('HTTP_REFERER');
        // $previous_url = $_SERVER['HTTP_REFERER'];
        // if(!str_contains(url()->previous(),"https://asu.org.sd") || is_null($request->server('HTTP_REFERER')))
        if (is_null($request->server('HTTP_REFERER'))) {
            $route = Route::getFacadeRoot()->current()->uri();
            $visitor = new Visitor();

            $visitor->ip_address = $request->ip();
            $visitor->page = "$route";

            $visitor->save();
        }

        Session(['count_of_visitors' => Visitor::count()]);

        return $next($request);
    }
}
