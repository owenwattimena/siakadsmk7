<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'jurusan';


    /**
     * Get all of the kurikulum for the Jurusan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kurikulum()
    {
        return $this->hasMany(Kurikulum::class, 'jurusan_kode', 'kode');
    }
}
