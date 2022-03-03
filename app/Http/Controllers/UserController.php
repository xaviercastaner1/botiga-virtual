<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class UserController extends Controller
{

    public function show($id) {
        $user = User::findOrFail($id);
        
        return view('user.user', ['user' => $user]);
    }

    public function update($id) {
        $user = User::findOrFail($id);

    }
}
