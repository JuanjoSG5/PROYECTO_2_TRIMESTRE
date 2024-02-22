<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Http\Controllers\Api\Controller;   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Add this line

class AuthController extends Controller{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('token', ['expires_in' => 60])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        try {
            $fields = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string'
            ]);

            // Log the request data for debugging purposes
            Log::info('Login request received', ['email' => $fields['email']]);

            $user = User::where('email', $fields['email'])->first();

            // Log the user's hashed password and the password provided in the request
            Log::info('User password: ' . $user->password, ['password' => $fields['password']]);

            if (!$user || !Hash::check($fields['password'], $user->password)) {
                // Log failed login attempts
                Log::warning('Failed login attempt', ['email' => $fields['email']]);
                
                return response([
                    'message' => 'Bad credentials'
                ], 401);
            }

            $token = $user->createToken('token', ['expires_in' => 60])->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            // Log successful login
            Log::info('User logged in', ['email' => $fields['email']]);

            return response($response, 201);
        } catch (\Exception $e) {
            // Log any exceptions that occur during login
            Log::error('Login error: ' . $e->getMessage());
            
            // Return a generic error response
            return response([
                'message' => 'An error occurred during login'
            ], 500);
        }
    }


    public function checkUserExists(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
}
