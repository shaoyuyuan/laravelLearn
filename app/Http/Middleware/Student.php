<?php

namespace App\Http\Middleware;

/**
 * 
 */
class Student
{
	
	public function handle($request, Closure $next)
	{
		//代码
		return $next($request);
	}
}