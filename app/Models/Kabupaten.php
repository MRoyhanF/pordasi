<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kabupaten extends Model
{
    use SoftDeletes;

    protected $table = 'kabupaten';
    protected $fillable = ['name'];

    /**
     * Get all stables in this kabupaten
     */
    public function stables()
    {
        return $this->hasMany(Stable::class, 'idKabupaten');
    }

    /**
     * Get all atlets through stables
     */
    public function atlets()
    {
        return $this->hasManyThrough(Atlet::class, Stable::class, 'idKabupaten', 'idStable');
    }

    /**
     * Get all pelatih through stables
     */
    public function pelatih()
    {
        return $this->hasManyThrough(Pelatih::class, Stable::class, 'idKabupaten', 'stableId');
    }

    /**
     * Get all kuda through stables
     */
    public function kuda()
    {
        return $this->hasManyThrough(Kuda::class, Stable::class, 'idKabupaten', 'stable');
    }

    /**
     * Get admin for this kabupaten
     */
    public function adminKabupaten()
    {
        return $this->hasMany(AdminKabupaten::class, 'idKabupaten');
    }

    /**
     * Get stats for dashboard
     */
    public function getStats()
    {
        return [
            'total_stable' => $this->stables()->count(),
            'total_atlet' => $this->atlets()->count(),
            'total_pelatih' => $this->pelatih()->count(),
            'total_kuda' => $this->kuda()->count(),
        ];
    }
}
