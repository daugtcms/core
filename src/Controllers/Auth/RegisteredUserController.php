<?php

namespace Sitebrew\Controllers\Auth;

use Sitebrew\Controllers\Controller;
use Sitebrew\Core\Models\User;
use Sitebrew\SitebrewRouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'full_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'agb' => ['accepted'],
            'datenschutz' => ['accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(SitebrewRouteServiceProvider::HOME);
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('sitebrew::auth.register');
    }
}
