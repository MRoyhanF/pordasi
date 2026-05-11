<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminKabupaten extends Model
{
    protected $table = 'admin_kabupaten';
    public $timestamps = false;
    
    protected $fillable = ['idUser', 'idKabupaten', 'isActive'];
    protected $primaryKey = ['idUser', 'idKabupaten'];
    public $incrementing = false;
    protected $keyType = 'array';

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
