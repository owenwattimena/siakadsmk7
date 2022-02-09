<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Semester;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users',
        ]);
        
        $credential = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        
        $remember_me  = ( !empty( $request->remember_me ) ) ? TRUE : FALSE;

        if(Auth::attempt($credential)){
            $user = User::where( ["username" => $credential['username']] )->first();
            
            Auth::login($user, $remember_me);

            $semesterAktif = Semester::where('is_aktif',1)->first();
            $semesterId = $semesterAktif->id ?? 0;
            $request->session()->put('semester_id', $semesterId);

            if($user->level_id == 1 || $user->level_id == 2){
                return redirect()->route('dashboard');
            }else if($user->level_id == 3){
                return redirect()->route('dashboard-guru');
            }else if($user->level_id == 4){
                return redirect()->route('dashboard-siswa');
            }else{
                return redirect()->route('logout');
            }

        }
        return redirect()->route('login')->with(AlertFormatter::danger("Login Gagal"));
        
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}