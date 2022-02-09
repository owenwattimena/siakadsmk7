<?php

namespace App\Models;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurikulum extends Model
{
    use HasFactory;

    protected $table = 'kurikulum';



    /**
     * Get the jurusan that owns the Kurikulum
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_kode', 'kode');
    }

    /**
     * Get all of the matapelajaran for the Kurikulum
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matapelajaran()
    {
        return $this->hasMany(Matapelajarankurikulum::class, 'kurikulum_id', 'id');
    }
}
