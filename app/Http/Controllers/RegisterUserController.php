<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller {

    public function create() {
        return view('auth.create');
    }

    public function show(string $id) {
        $user = User::find($id);

        return view('auth.show', ['user' => $user]);
    }

    public function store(UserStoreRequest $request) {

        $user = User::create($request->only(['first_name', 'last_name', 'email', 'password']));

        Auth::login($user);

        return view('auth.show', ['user' => $user]);
    }

}
