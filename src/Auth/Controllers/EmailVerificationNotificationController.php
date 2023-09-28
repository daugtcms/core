<?php

namespace Felixbeer\SiteCore\Auth\Controllers;

use Felixbeer\SiteCore\Core\Controllers\Controller;
use Felixbeer\SiteCore\SiteCoreRouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(SiteCoreRouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
