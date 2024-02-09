<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {   
        switch (auth()->guard()->name) {
            case 'web':
                $redirectTo = route('user.login');
                break;
            
            default:
                $redirectTo = null;
                break;
        }

        return $redirectTo;
    }
}
