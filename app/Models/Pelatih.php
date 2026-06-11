<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelatih extends Model
{
    protected $table = 'pelatih';
    public $timestamps = false;
    
    protected $fillable = ['userId', 'stableId', 'isActive', 'level'];
    protected $primaryKey = ['userId', 'stableId'];
    public $incrementing = false;
    protected $keyType = 'array';

    /**
     * Get the user that this pelatih belongs to
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    /**
     * Get the stable that this pelatih belongs to
     */
    public function stable()
    {
        return $this->belongsTo(Stable::class, 'stableId');
    }
}
