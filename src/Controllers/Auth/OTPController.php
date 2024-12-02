<?php

namespace Daugt\Controllers\Auth;

use Daugt\Controllers\Controller;
use Daugt\Jobs\Shop\SyncStripeUser;
use Daugt\Models\User;
use Daugt\Requests\Auth\LoginRequest;
use Daugt\DaugtRouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OTPController extends Controller
{
    public function view()
    {
        return view('daugt::auth.login-otp');

        // send otp code to user


    }

    public function check(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        return $this->verifyOtp($request->otp, $request->session()->get('email'));
    }

    public function checkLink(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
            'email' => 'required|email',
        ]);

        return $this->verifyOtp($request->otp, $request->email);
    }

    public function verifyOtp($requestOtp, $email) {
        $otpCode = Cache::get('otp-code-' . $email);

        if($otpCode == $requestOtp) {
            $user = User::where('email', $email)->first();
            Cache::forget('otp-code-' . $email);
            Cache::forget('otp-attempts-' . $email);
            if($user->email_verified_at == null) {
                $user->email_verified_at = now();
                $user->save();
            }
            SyncStripeUser::dispatch($user);
            Auth::login($user, true);
            request()->session()->regenerate();
            return redirect()->intended(DaugtRouteServiceProvider::HOME);
        } else {
            // check if attempts exist
            if(!Cache::has('otp-attempts-' . $email)) {
                Cache::put('otp-attempts-' . $email, 1, now()->addMinutes(15));
            } else {
                Cache::increment('otp-attempts-' . $email);
            }

            if((int)Cache::get('otp-attempts-' . $email) >= 5) {
                Cache::forget('otp-code-' . $email);
                Cache::forget('otp-attempts-' . $email);
                return redirect()->route('daugt.login')->withErrors(['otp' => 'Too many attempts']);
            }

            // unauthorized 403
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP']);
        }
    }
}
