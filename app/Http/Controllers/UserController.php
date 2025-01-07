<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    //signup
    public function register()
    {

        $title = "Register";

        return view('auth.signup', compact('title'));
    }


    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        update_field('role', 'user', 'user', $user->id);
        
        //user login
        auth()->login($user); 

        return redirect()->route('home');
    }


    //index
    public function login()
    {

        $title = "Login";

        return view('auth.login', compact('title'));
    }

    public function loginStor(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Find the user by email
        $user = User::where('email', $request->email)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            // Log in the user (set session)
            auth()->login($user);
    
            // Redirect to home route
            return redirect()->route('home')->with('success', 'Logged in successfully!');
        }
    
        // Redirect back with error message
        return redirect()->back()->with('error', 'Email or password is incorrect!');
    }
    

    //logout
    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }


    //profile
    public function profile()
    {

        $user = auth()->user();

        return view('home.profile', compact('user'));
    }

    //profileUpdate
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {

            $request->validate([
                'current_password' => 'required|min:6',
                'password' => 'required|min:6',
            ]);
            
            //current password check
            if (Hash::check($request->current_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            } else {
                return back()->with('error', 'Current password is incorrect!');
            }

        }



        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }









}


