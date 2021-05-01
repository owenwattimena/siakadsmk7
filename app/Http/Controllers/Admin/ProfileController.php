<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $user = User::findOrFail(\Auth::user()->id);
        $user->name = $request->name;
        if($user->save()) return redirect()->back()->with(AlertFormatter::success("Profile updated"));
        return redirect()->back()->with(AlertFormatter::danger("Profile failed to update"));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        if (!Hash::check($request->password, \Auth::user()->password)) return redirect()->back()->with(AlertFormatter::danger("Your enter wrong password"));

        $user = User::findOrFail(\Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        if( !$user->save() ) return redirect()->back()->with(AlertFormatter::danger("Failed to change password"));
        \Auth::logout();
        return redirect()->route('login')->with(AlertFormatter::success("Password successfully changed"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}