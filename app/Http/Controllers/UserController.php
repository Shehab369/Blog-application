<?php

namespace App\Http\Controllers;


use App\Models\Auth\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    // public function index()
    // {
    //     $users = User::all();
    //     return view('users.info', compact('users'));
    // }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'  => ['required', 'string', 'min:6', 'confirmed'], 
            'birthdate' => ['required', 'date', 'before:today'],
        ]);

       
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $user = User::create($data);

        
        session(['user_id' => $user->id]);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'Registration Succesful :)');
    }


    public function showLogin()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $cred = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $cred['email'])->first();

        if (!$user || !password_verify($cred['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid email or password'])
                ->withInput();
        }

        session(['user_id' => $user->id]);
        $request->session()->regenerate(); 
        return redirect()->intended(route('dashboard'))->with('success', 'Login Succesful :)');
    }


    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.show')->with('success', 'You logged out !');
    }


    public function dashboard()
    {
        $user = User::find(session('user_id'));
        return view('dashboard', compact('user'));
    }
    
}
