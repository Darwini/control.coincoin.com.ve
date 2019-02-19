<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $table='workers';
    protected $fillable=['cedula','nombres', 'telefono', 'status', 'user_id'];
    // public $timestamps = true;
    public function user()
    {
      return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function datos_personales()
    {
      return $this->hasMany('App\Models\Ubicaciones', 'user_id', 'id');
    }
}
