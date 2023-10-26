<?php

namespace Sitebrew\Controllers\Auth;

use Sitebrew\Controllers\Controller;
use Sitebrew\SitebrewRouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(SitebrewRouteServiceProvider::HOME)
            : view('sitebrew::auth.verify-email');
    }
}