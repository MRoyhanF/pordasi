<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atlet extends Model
{
    use SoftDeletes;

    protected $table = 'atlet';
    protected $fillable = ['idStable', 'nama', 'level', 'jenisKelamin', 'tanggal_lahir', 'asal_daerah'];

    /**
     * Get the stable that owns this atlet
     */
    public function stable()
    {
        return $this->belongsTo(Stable::class, 'idStable');
    }

    /**
     * Get the kabupaten through stable
     */
    public function getKabupatenAttribute()
    {
        return $this->stable ? $this->stable->kabupaten : null;
    }
}
