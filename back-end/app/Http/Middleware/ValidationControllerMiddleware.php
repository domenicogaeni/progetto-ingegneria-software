<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidationControllerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        list($controllerName, $methodName) = explode('@', $request->route()[1]['uses']);
        $validationRules = $controllerName::getValidationRules();        
        if (array_key_exists($methodName, $validationRules)) {
            $methodRules = $validationRules[$methodName];
            try {
                $validator = app('validator')->make($request->all(), $methodRules);
                $validator->validate();
            } catch (\Throwable $th) {
                abort($th->status, $th->getMessage());
            }
            
        }

        return $next($request);
    }
}
