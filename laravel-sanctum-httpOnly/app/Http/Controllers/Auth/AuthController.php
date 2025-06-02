<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {

        try {
            $credentials = $request->only('email', 'password');
            // Validate the request data
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);


            if (!Auth::attempt($credentials)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            };


            $request->session()->regenerate();

            return response()->json([
                'message' => 'Login successful',
                'user' => Auth::user(),
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'message' => 'Logout successful',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Logout failed',
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6',
            ]);

            if ($request->email) {
                $user  = User::where('email', $request->email)->first();

                if ($user) {
                    return throw ValidationException::withMessages([
                        'email' => ['Email already exists'],
                    ]);
                }

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                return response()->json([
                    'message' => 'Registration successful',
                    'user' => $user,
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Registration failed',
                'error' => $th->getMessage(),
            ]);
        }
    }
}
