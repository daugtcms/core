<?php

namespace Daugt\Controllers\Auth;

use Daugt\Controllers\Controller;
use Daugt\Models\User;
use Daugt\Notifications\Auth\OneTimePassword;
use Daugt\Requests\Auth\LoginRequest;
use Daugt\DaugtRouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();

        $request->session()->put('email', $request->email);
        if($user && $user->password) {
            return redirect()->route('daugt.login.password');
        } else {
            if(!$user) {
                if($request->has('agb') && $request->has('datenschutz')) {
                    $request->validate([
                        'agb' => 'accepted',
                        'datenschutz' => 'accepted',
                    ]);

                    $user = User::create([
                        'email' => $request->email,
                    ]);
                } else {
                    return redirect()->back()->with('accept-terms')->withInput();
                }
            }

            $otpCode = rand(000000, 999999);
            $otpCode = str_pad($otpCode, 6, '0', STR_PAD_LEFT);

            $otpCode = Cache::remember('otp-code-' . $request->email, now()->addMinutes(15), function () use ($otpCode) {
                return $otpCode;
            });

            $signedUrl = URL::temporarySignedRoute('daugt.login.otp.verify.link', now()->addMinutes(15), ['email' => $request->email, 'otp' => $otpCode], false);
            // add current domain to relative signed url
            $signedUrl = Str::of($signedUrl)->prepend(request()->getSchemeAndHttpHost());

            $user->notify(new OneTimePassword($otpCode, $signedUrl));

            return redirect()->route('daugt.login.otp');
        }
    }
}
