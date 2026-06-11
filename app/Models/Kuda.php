<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kuda extends Model
{
    use SoftDeletes;

    protected $table = 'kuda';
    protected $fillable = ['stable', 'nama', 'pasport', 'prestasi', 'pemilik'];

    /**
     * Get the stable that owns this kuda
     */
    public function stableData()
    {
        return $this->belongsTo(Stable::class, 'stable');
    }
}
