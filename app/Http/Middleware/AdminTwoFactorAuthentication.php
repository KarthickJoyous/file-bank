<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\Admin;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminTwoFactorAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        {   
            try {
    
                throw_if(!$decrypt = decrypt($request->__token), new Exception); // Decrypt will retrun admin email, unique_id & timestamp if success (Check Admin\LoginController::login())
    
                throw_if($decrypt['timestamp'] != now()->addMinute(1)->format('Y-m-d h:i A e'), new Exception);
    
                unset($decrypt['timestamp']);
    
                throw_if(!$admin = Admin::firstWhere($decrypt), new Exception);
    
                $request->attributes->add(['admin' => $admin]);
    
                return $next($request);
    
            } catch(Exception $e) {
    
                return redirect()->route('admin.login')->with('error', __('messages.admin.tfa_login.forbidden'));
            }
        }
    }
}
