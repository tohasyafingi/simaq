<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Auth\RedirectsToRoleDashboard;

class EmailVerificationPromptController extends Controller
{
    use RedirectsToRoleDashboard;
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
                    ? $this->redirectToRoleDashboard($request->user()->role)
                    : view('auth.verify-email');
    }
}
