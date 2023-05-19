<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CodeMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    // dd($request->code);
    // if ($request->code == 123) {
    // } else {
    //   return redirect()->back()->withErrors(['code' => 'wrong code']);
    // }

    return $next($request);
  }
}
