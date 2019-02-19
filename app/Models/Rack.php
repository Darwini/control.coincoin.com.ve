<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    protected $table = 'racks';
    protected $fillable = ['rack', 'area_id', 'filas', 'columnas'];

    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'area_id', 'id');
    }
}
