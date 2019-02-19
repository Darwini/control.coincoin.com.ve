<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table= 'areas';
    protected $fillable= ['area', 'sala_id', 'descripcion'];

    public function sala()
    {
    	return $this->belongsTo('App\Models\Sala', 'sala_id', 'id');
    }

    public function racks()
    {
    	return $this->hasMany('App\Models\Rack', 'area_id', 'id');
    }
}
