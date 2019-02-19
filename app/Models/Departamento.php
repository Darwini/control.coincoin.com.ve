<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';
    protected $fillable = ['departamento', 'descripcion', 'status'];
    public $timestamps = 'false';
    
    public function depuser()
    {
        return $this->hasOne('App\User', 'group_id', 'id');
    }
}
