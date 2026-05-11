<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kuda extends Model
{
    use SoftDeletes;

    protected $table = 'kuda';
    protected $fillable = ['stable', 'nama', 'jenis', 'warna', 'usia', 'tanggal_masuk'];

    /**
     * Get the stable that owns this kuda
     */
    public function stable()
    {
        return $this->belongsTo(Stable::class, 'stable');
    }

    /**
     * Get the kabupaten through stable
     */
    public function getKabupatenAttribute()
    {
        return $this->stable ? $this->stable->kabupaten : null;
    }
}
