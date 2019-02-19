<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table='salas';
    protected $primary_key='id';
    protected $fillable=['sala','descripcion'];

    public function areas()
    {
        return $this->hasMany('App\Models\Area', 'sala_id', 'id');
    }

}
