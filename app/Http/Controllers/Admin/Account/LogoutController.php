<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, RedirectResponse};

class LogoutController extends Controller
{
    /**
     * Log the admin out of the application.
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        auth('admin')->logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', __('messages.admin.logout.logout_success'));
    }
}
