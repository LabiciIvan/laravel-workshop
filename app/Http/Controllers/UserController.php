<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Events\ModelInteractions;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        ModelInteractions::dispatch($users);

        return UserResource::collection(User::all());
    }

}
