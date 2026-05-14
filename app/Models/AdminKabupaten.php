<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminKabupaten extends Model
{
    use SoftDeletes;

    protected $table = 'admin_kabupaten';
    public $timestamps = true;
    
    protected $fillable = ['idUser', 'idKabupaten', 'isActive'];
    protected $primaryKey = ['idUser', 'idKabupaten'];
    public $incrementing = false;
    protected $keyType = 'array';
    protected $dates = ['deleted_at'];

    /**
     * Get the user that this admin belongs to
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    /**
     * Get the kabupaten that this admin manages
     */
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'idKabupaten');
    }
}
