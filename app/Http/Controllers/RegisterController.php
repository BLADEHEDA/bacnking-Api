<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends ResponseController
{
    /**
     * Create user account.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Validate the data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',  // password confirmation validation
            'phone' => 'nullable|string|max:15', // Optional phone field
        ]);

        // If validation fails
        if ($validator->fails()) {
            return $this->formatJson($validator->errors()->first(), "Bad Request", 400);
        }

        // Check if email already exists in the database
        if (User::where('email', $request->email)->exists()) {
            return $this->formatJson("This email address exists. Please login or reset your password.", "FAILURE", 409);
        }

        // Create a new user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Encrypt password

        // Optional: Add phone number if present
        if ($request->has('phone') && !empty($request->phone)) {
            $user->phone = $request->phone;
        }

        // Save the user
        if ($user->save()) {
            // Generate API token (if using Passport or Sanctum, otherwise use the access key)
            $token = $user->createToken('YourAppName')->accessToken;

            // Return the response with the generated token
            return $this->formatJson("Registration successful", "SUCCESS", 201, [
                'user' => $user,
                'token' => $token,
            ]);
        } else {
            return $this->formatJson("An error occurred and your account was not created. Please try again.", "FAILURE", 406);
        }
    }
}
