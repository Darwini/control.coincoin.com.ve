<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table="ubicaciones";
    protected $primary_key='id';
    protected $fillable = [ 'cliente_user_id', 'instalador_user_id', 'modelo', 'serial_equipo', 'serial_fuente', 'rack_id', 'posicion', 'status', 'minero_id', 'minero_nombre'];
    
    public function rack()
    {
        return $this->belongsTo('App\Models\Rack', 'rack_id', 'id');
    }

    public function userclient()
    {
        return $this->belongsTo('App\User', 'cliente_user_id', 'id');
    }

    public function installer()
    {
        return $this->belongsTo('App\User', 'instalador_user_id', 'id');
    }

    /*Funcion estatica para algun ajax, esta recibe el rack_id como parametro y devuelve muchos registros, posiciones, seriales equipos, seriales fuentes, etc*/
    public static function ocupados($id)
    {
        $ocupados = Instalaciones::where('rack_id', $id)->get();
        return $ocupados;
    }
}
