<?php

namespace Daugt\Controllers\Auth;

use Daugt\Controllers\Controller;
use Daugt\DaugtRouteServiceProvider;
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
            ? redirect()->intended(DaugtRouteServiceProvider::HOME)
            : view('daugt::auth.verify-email');
    }
}
