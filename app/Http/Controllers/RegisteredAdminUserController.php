<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredAdminUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register-admin');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:' . User::class,
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        /**
         * Create new user with password encryption.
         *
         * @var User
         */
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('admin');

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
