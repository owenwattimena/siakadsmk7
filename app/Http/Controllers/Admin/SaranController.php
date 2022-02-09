<?php

namespace App\Http\Controllers\Admin;

use App\Models\Saranmasukan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaranController extends Controller
{
    public function index()
    {
        $saran = Saranmasukan::with('siswa')->get();
        $data['saran'] = $saran;
        return view('admin.saran.index', $data);
    }
}
