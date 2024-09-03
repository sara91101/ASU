<?php

namespace App\Http\Middleware;

use App\Models\LevelOperation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class Privileges
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $route = Route::currentRouteName();

        if($user->level_id == 1)
        {
            return back()->with("NoAccess","ليس لديك صلاحية الدخول لهذه الصفحة");
        }

        if($user->level_id != 2 && $route != "home" && $route != "change_password")
        {
            $privilige = LevelOperation::join("page_operations","page_operations.id","level_operations.operation_id")
            ->join("page_sub_operations","page_sub_operations.operation_id","page_operations.id")
            ->where("level_id",$user->level_id)
            ->where("sub","$route")
            ->exists();


            if($privilige)
            {
                return $next($request);
            }
            else
            {
                return back()->with("NoAccess","ليس لديك صلاحية الدخول لهذه الصفحة");
            }
        }
        else
        {
            return $next($request);
        }
    }
}
