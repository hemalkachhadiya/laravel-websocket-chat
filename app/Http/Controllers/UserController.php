<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function finduser(Request $request)
    {
        if ($request->has('email')) {
            $user =  User::where('email', $request->email)->first();
            return isset($user) ? response()->json(['data' => $user ,'message' => 'User Found']) : response()->json(['message' => 'User Not Found'],404);
        }
        return abort(404, "Please Enter Email Id");
    }
}
