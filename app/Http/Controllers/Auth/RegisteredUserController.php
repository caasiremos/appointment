<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Contracts\Foundation\Application;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create()
    {
        $roles = Role::get();

        return view('auth.register', compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     * @return RedirectResponse
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'position' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'position' => $request->position,
            'password' => Hash::make($request->password),
        ]);

        $selectedRole = Role::findOrFail($request->role);

        event(new Registered($user));

        $user->attachRole($selectedRole);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
