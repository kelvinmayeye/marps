<?php

namespace App\Http\Controllers;

use App\Models\Admin\Exam;
use App\Models\Admin\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $dashboardData = [];
            $dashboardData['recentSchools'] = School::query()->latest('id')->limit(5)->get()->toArray();
            $dashboardData['examinationSummary'] = Exam::query()->get();

//            mydebug($dashboardData);
            return view('pages.shared.dashboard', compact('user','dashboardData'));
        } else {
            return view('pages.auth.login-page');
        }
    }

    public function login(Request $request)
    {
        //get token
        $token = $request->get('remember_token');
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->input('username'))->first();
        if (!$user || !\Hash::check($request->input('password'), $user->password)) return back()->with('error', 'Wrong username or password');


        if(!empty($token)){
            if($user->remember_token === $token){
                $user->update(['remember_token'=>null,'status'=>'active']);
                toastr()->success('Your Token is verified successful');
            }else{
                back()->with('error', 'The Entered Token did not match.Try please again');
            }
        }

        if($user->status === 'accepted'){
            if (!is_null($user->remember_token)) {
                session()->put('confirm_token', 'Account is request accepted but please confirm your token first.');
                return back()
                    ->withInput($request->only('username', 'password'))
                    ->with('error', 'Account is request accepted but please confirm your token first.');
            } else{
                return back()->with('error', 'Account is request accepted but request for new token');
            }
        }

        if ($user->status !== 'active') {
            if ($user->status === 'pending')  return back()->with('error', 'Login denied. Your account is pending approval.');
            if ($user->status === 'rejected')  return back()->with('error', 'Login denied. Your account request has been rejected');
            return back()->with('error', "Login denied. Your account status is: $user->status.");
        }

        if ($user->status === 'active') {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('user.home');
        }

        return back()->with('error', 'Your account is not active.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.home');
    }


    public function registerUser(){
        $schools = School::all();
        return view('pages.auth.register-page',compact('schools'));
    }

    public function register(Request $request)
    {
        try {
            $user = $request->except('_token');

            // Check if username already exists
            if (User::where('username', $user['username'])->exists()) {
                return back()->with('error', 'Username already exists');
            }

            // Check if phone number already exists
            if (User::where('phone_number', $user['phone_number'])->exists()) {
                return back()->with('error', 'Phone number already exists');
            }

            // Check if password and confirm_password match
            if ($user['password'] !== $user['confirm_password']) {
                return back()->with('error', 'Passwords do not match');
            }

            // Create user
            $newUser = new User();
            $newUser->name = $user['name'];
            $newUser->title = $user['title'];
            $newUser->username = $user['username'];
            $newUser->role_id = 2;
            $newUser->email = $user['email'];
            $newUser->password = Hash::make($user['password']);
            $newUser->phone_number = $user['phone_number'];
            $newUser->school_id = $user['school_id'];
            $newUser->school_position = $user['school_position'];
            $newUser->save();

            return redirect()->to(url('/'))->with('success', 'Account request sent. You\'ll receive a confirmation code once approved.');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function ajax_confirm_username(Request $request)
    {
        try {
            $username = $request->input('username');
            // Check if username exists
            $exists = User::where('username', $username)->exists();

            return response()->json(['exists' => $exists]);
        } catch (\Exception $e) {
            return response()->json([
                'exists' => false,
                'error' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function ajax_confirm_phone(Request $request)
    {
        try {
            $exists = User::where('phone_number', $request->input('phone_number'))->exists();
            return response()->json(['exists' => $exists]);
        } catch (\Exception $e) {
            return response()->json([
                'exists' => false,
                'error' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

}
