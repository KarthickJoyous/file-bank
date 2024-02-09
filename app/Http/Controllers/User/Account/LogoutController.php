<?php

namespace App\Http\Controllers\User\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, RedirectResponse};

class LogoutController extends Controller
{
    /**
     * Log the user out of the application.
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        auth('web')->logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        return redirect()->route('user.login')->with('success', __('messages.user.logout.logout_success'));
    }
}
