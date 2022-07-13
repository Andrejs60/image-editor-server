<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        // Get form fields
        $formFields = $request->all();

        User::create([
            "name" => $formFields["name"],
            "email" => $formFields["email"],
            "password" => bcrypt($formFields["password"])
        ]);

        return response()->json([
            "message" => "Registered successfully."
        ], 201);
    }

    public function login(LoginRequest $request){
        if (Auth::guard()->attempt($request->only("email", "password"))) {
            $request->session()->regenerate();

            return response()->json(["message" => "Logged in."], 204);
        }

        return response()->json(["error" => "Invalid credentials."]);
    }

    public function logout(Request $request){
        Auth::guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            "message" => "Logged out."
        ], 204);
    }
}
