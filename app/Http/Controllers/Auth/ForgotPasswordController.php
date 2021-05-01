<?php

namespace App\Http\Controllers\Auth;

use DB; 
use Mail;
use Carbon\Carbon; 
use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }
    
    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        
        // $token = Str::random(64);
        $token = csrf_token();
        
        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
        
        // Mail::send('customauth.verify', ['token' => $token], function($message) use($request){
        //     $message->to($request->email);
        //     $message->subject('Reset Password Notification');
        // });
        $user = User::where('email', $request->email)->get()->first();
        Mail::to($request->email)->send(new ResetPassword($user, $token));
        
        return back()->with(AlertFormatter::success('We have e-mailed your password reset link!'));
    }

    public function resetPassword($token){
        return view('auth.reset-password', ['token'=> $token]);
    }
    public function updatePassword(Request $request, $token){
        
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        
        $updatePassword = DB::table('password_resets')
                      ->where(['email' => $request->email, 'token' => $token])
                      ->first();
                      
        if(!$updatePassword) return back()->withInput()->with(AlertFormatter::danger('Invalid token!'));

        $user = User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with(AlertFormatter::success('Your password has been changed!'));
    }
}