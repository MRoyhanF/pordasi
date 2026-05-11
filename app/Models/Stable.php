<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stable extends Model
{
    use SoftDeletes;

    protected $table = 'stable';
    protected $fillable = ['idKabupaten', 'nama', 'pemilik', 'alamat_stable', 'pimpinan_stable', 'mulai_berdiri'];

    /**
     * Get the kabupaten that owns this stable
     */
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'idKabupaten');
    }

    /**
     * Get all atlets in this stable
     */
    public function atlets()
    {
        return $this->hasMany(Atlet::class, 'idStable');
    }

    /**
     * Get all pelatih in this stable
     */
    public function pelatih()
    {
        return $this->hasMany(Pelatih::class, 'stableId');
    }

    /**
     * Get all kuda in this stable
     */
    public function kuda()
    {
        return $this->hasMany(Kuda::class, 'stable');
    }
}
