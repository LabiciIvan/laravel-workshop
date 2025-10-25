<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create() {
        return view('auth.login');
    }

    public function store(UserLoginRequest $request) {

        $user = User::where('email', $request->input('email'))->first();

        $attributes = $request->validated();

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, these credentials don\'t match'
            ]);
        }

        request()->session()->regenerate();
        // Auth::login($user);

        return view('auth.show', ['user' => $user]);
    }

    public function destroy(string $id) {
        Auth::logout();

        return view('auth.login');
    }
}
