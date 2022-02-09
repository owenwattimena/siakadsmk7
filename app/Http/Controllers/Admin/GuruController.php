<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        $jurusan = Jurusan::all();
        $data['jurusan'] = $jurusan;
        $data['guru'] = $guru;
        return view('admin.guru.index',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required|numeric',
            'nign' => 'required',
            'nama' => 'required',
        ]);

        $guru = new Guru;
        $guru->nign = $request->nign;
        $guru->nip = $request->nip;
        $guru->nama = $request->nama;
        $guru->jurusan_id = $request->jurusan_id;

        if($guru->save())
        {
            $newUser = new User;
            $newUser->name = $request->nama;
            $newUser->email = $request->email;
            $newUser->username = $request->nign;
            $newUser->password = Hash::make('password');
            $newUser->nign = $request->nign;
            $newUser->level_id = 3;

            $newUser->save();
            
            return redirect()->back()->with(AlertFormatter::success("Data Guru berhasil di simpan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Guru gagal di simpan."));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'email',
        ]);

        $guru = Guru::findOrFail($id);
        $guru->nama = $request->nama;

        if($guru->save())
        {
            $newUser = User::where('nign', $guru->nign)->first();
            $newUser->name = $request->nama;
            $newUser->email = $request->email;

            $newUser->save();
            
            return redirect()->back()->with(AlertFormatter::success("Data Guru berhasil di simpan."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Guru gagal di simpan."));
    }

    public function delete($id)
    {
        $guru = Guru::findOrFail($id);
        if(Guru::destroy($id))
        {
            User::where('nign', $guru->nign)->delete();
            return redirect()->back()->with(AlertFormatter::success("Data Guru berhasil di hapus."));
        }
        return redirect()->back()->with(AlertFormatter::danger("Data Guru gagal di hapus."));
    }
}
