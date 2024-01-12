<?php

namespace App\Http\Controllers;

use App\Http\Requests\userRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Authentication extends Controller
{
    /**
     * Login using the specified resource.
     */
    public function login(userRequest $request)
    {



        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ], 401); // 401 for unauthorized access
        }

        // If credentials are correct, you can generate a token or any other necessary logic here
        // For instance, you might generate a JWT token for authentication

        // Assuming you generate a token, you can return it in the JSON response
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user // You might want to send user details for frontend use
        ], 200); // 200 for success



        return response()->json(
            [
                'message' => 'Login successful',
                'data' => [
                    'user' => $user,
                    'token' => $user->createToken($request->email)->plainTextToken
                ],
            ],
            200
        );
    }

    /**
     * Logout using the specified resource.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $response = [
            'message' => 'logout.'
        ];

        return $response;
    }
}
