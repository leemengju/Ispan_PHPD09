<!-- <---------------------------------檢查輸入是否正確--------------> -->
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $a = $request->a;
        $b = $request->b;
        if (is_numeric($a) && is_numeric($b)) {

            return $next($request);
        }
        die("error");
    }
}
