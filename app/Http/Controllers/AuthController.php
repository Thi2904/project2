<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //GET : /login
    function viewLogin()
    {
        return view('auth.login');
    }

    function viewRegis()
    {
        return view('auth.register');
    }

    function viewDashboard()
    {
        return view('admin.home');
    }
    //POST: /login
    function login(Request $request)
    {
        // Xu ly dang nhap
        $email = $request -> get("email");
        $password = $request -> get("password");

        if (Auth::attempt(["email" => $email, "password" => $password])){
            //check role
            $user = Auth::user();
//            dd($user);
            switch ($user -> role){
                case "admin":
                    return redirect()->route("admin.home");
                    break;
                case "teacher":
                    return redirect()->route("teacher.classForCheckin");
                    break;
            }
        }
        else{
            //chuyen ve login
            return redirect()->back();
        }
    }


    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string' // Add validation for the role field
        ]);

        // Hash the password before saving it to the database
        $data['password'] = Hash::make($data['password']);

        // Create the user record in the database
        $user = User::create($data);

        // Perform any additional actions or redirects as needed

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    //POST: /logout
    function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }
}
