<?php

namespace App\Http\Controllers;

Use Str;
Use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class RegisterController extends Controller
{


    public function User_login()
    {
        return view('register.create');
    }
 public function create()
    {
        return view('user.login.index');
    }
    public function store()
    {
        $validator = \Validator::make(request()->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
            ],
            'passwordMatch' => [
                'required',
                'string',
                'min:8',
                'max:20',
            ],
        ], [
            'name.required' => 'Please enter your username.',
            'name.max' => 'Your username may not exceed 255 characters.',
            'email.required' => 'Please enter your email.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Your email may not exceed 255 characters.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'Please enter your password.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password may not exceed 20 characters.',
            'passwordMatch.required' => 'Please confirm your password.',
            'passwordMatch.min' => 'Password confirmation must be at least 8 characters.',
            'passwordMatch.max' => 'Password confirmation may not exceed 20 characters.',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode("<br>", $errors);
            
            return response()->json([
                'result' => "signupErrorMessage.innerHTML ='".$errorMessage."'"
            ]);
        }
    
        // Password match validation
        if (request()->input('password') !== request()->input('passwordMatch')) {
            return response()->json([
                'result' => "signupErrorMessage.innerHTML ='The password confirmation does not match.'"
            ]);
        }
    
        // Create the user
        $user = new \App\Models\User();
        $user->name = request()->input('name');
        $user->email = request()->input('email');
        $user->password = request()->input('password'); 
        $user->role = request()->input('role');
        $user->save();
    
        // Log the user in
        auth()->login($user);
    
        // Return success response
        return response()->json([
            'result' => "
    signupErrorMessage.innerHTML = '<span style=\"color:green;\">Registration successful! Redirecting in 2 seconds...</span>';
    setTimeout(() => {
        window.location.href = '/admin/dashboard';
    }, 2000);
"
        ]);
    }
    
 
}
