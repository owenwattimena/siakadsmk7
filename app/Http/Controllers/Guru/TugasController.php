<?php

namespace App\Http\Controllers\Guru;

use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class TugasController extends Controller
{
    public function index($kelasId)
    {
        $data['kelas'] = DB::table('kelas')
            ->select('kelas.nama', 'matapelajarankurikulum.semester', 'matapelajarankurikulum.nama as nama_mapel')
            ->join('matapelajarankurikulum', 'matapelajarankurikulum.id', '=', 'kelas.mapel_kuri_id')
            ->where('kelas.id', $kelasId)
            ->first();

        $data['tugas'] = DB::table('tugas')
            ->where('kelas_id', $kelasId)
            ->get();
        $data['kelasId'] = $kelasId;
        return view('guru.tugas', $data);
    }

    public function create(Request $request, $kelasId)
    {
        $request->validate([
            'judul' =>'required',
            'keterangan' => 'required',
        ]);
        
        $file = $request->file('file');

        if($file){
            $path = Storage::putFile('public/tugas', $file);
        }

        $tugas = new Tugas;
        $tugas->kelas_id = $kelasId;
        $tugas->judul = $request->judul;
        $tugas->keterangan = $request->keterangan;
        if($file){
            $tugas->file = $path;
        }

        if($tugas->save())
        {
            return back()->with(AlertFormatter::success('Berhasil menambahkan tugas'));
        }
        else
        {
            return back()->with(AlertFormatter::danger('Gagal menambahkan tugas'));
        }
    }

    public function update(Request $request, $kelasId)
    {
        $request->validate([
            'judul' =>'required',
            'keterangan' => 'required'
        ]);

        $tugas = Tugas::find($request->id_tugas);
        $tugas->judul = $request->judul;
        $tugas->keterangan = $request->keterangan;
        $oldFile = $tugas->file;
        if($request->hasFile('file')){
            $path = Storage::putFile('public/tugas', $request->file('file'));
            $tugas->file = $path;
            Storage::delete($oldFile);

        }
        if ($tugas->save()) {

            return back()->with(AlertFormatter::success('Tugas berhasil diubah'));
        }
        return back()->with(AlertFormatter::danger('Tugas gagal diubah'));
    }

    public function detail($kelasId, $idTugas)
    {
        $data['kelas'] = DB::table('kelas')
            ->select('kelas.nama', 'matapelajarankurikulum.semester', 'matapelajarankurikulum.nama as nama_mapel')
            ->join('matapelajarankurikulum', 'matapelajarankurikulum.id', '=', 'kelas.mapel_kuri_id')
            ->where('kelas.id', $kelasId)
            ->first();
        $data['tugas'] = DB::table('detail_tugas')
            ->join('siswa','siswa.id','=','detail_tugas.siswa_id')
            ->where('detail_tugas.tugas_id', $idTugas)
            ->get();
        $data['kelasId'] = $kelasId;
        return view('guru.detail-tugas', $data);
    }
    
    public function delete($kelasId, $idTugas)
    {
        $tugas = Tugas::find($idTugas);
        $file = $tugas->file;
        if ($tugas->delete()) {
            Storage::delete($file);
            return back()->with(AlertFormatter::success('Tugas berhasil dihapus'));
        }
        return back()->with(AlertFormatter::danger('Tugas gagal dihapus'));
    }

}
