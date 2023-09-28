<?php

namespace Felixbeer\SiteCore\Auth\Controllers;

use Felixbeer\SiteCore\Core\Controllers\Controller;
use Felixbeer\SiteCore\SiteCoreRouteServiceProvider;
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
            ? redirect()->intended(SiteCoreRouteServiceProvider::HOME)
            : view('site-core::auth.verify-email');
    }
}
