<?php

namespace App\Models;

use App\Models\Dbs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';


    /**
     * Get the user that owns the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'nis', 'nis');
    }

    /**
     * Get the paketSemester associated with the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dbs()
    {
        return $this->hasMany(Dbs::class, 'siswa_nis', 'nis');
    }

    /**
     * Get the jurusan that owns the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_kode', 'kode');
    }
}
