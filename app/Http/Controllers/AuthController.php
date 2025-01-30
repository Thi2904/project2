<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
            switch ($user -> role){
                case "admin":
                    return redirect()->route("admin.home")->with('success','Đăng nhập thành công');
                    break;
                case "teacher":
                    session(['teacherID' => $user->id]);
                    return redirect()->route("teacher.TeachShift")->with('success','Đăng nhập thành công');
                    break;
                case "student":
                    session(['studentID' => $user->id]);
                    return redirect()->route("teacher.TeachShift");
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
        $checkMailandPhone = DB::table('users')->get();

        foreach ($checkMailandPhone as $cmp){
            if($request->input('email') === $cmp->email){
                return redirect()->route('showTeacher')->with('error', 'Email đã tồn tại vui lòng nhập mail khác');
            }elseif ($request->input('phone') === $cmp->phone){
                return redirect()->route('showTeacher')->with('error', 'Số điện thoại đã tồn tại, vui lòng nhập số khác');

            }
        }

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

        return redirect()->route('showTeacher')->with('success', 'Tạo tài khoản thành công');
    }

    public function registerStudent(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string' // Add validation for the role field
        ]);
        dd($data);
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
