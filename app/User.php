<?php
namespace App;

//use Laravel\Passport\HasApiTokens;
//use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use EntrustUserTrait;
use HasApiTokens,Notifiable;


class User extends Authenticatable
{

    protected $hidden = [ 'password', 'remember_token' ];    
    protected $table="users";
    protected $primaryKey = 'id';
    protected $fillable = [ 'username', 'email','password', 'remember_token', 'roles_id', 'group_id', 'status', 'puid', 'first_login','deduccion', 'porcentaje','pool', 'cobranza', 'cliente_id', 'url_pool' ];    

    public function useroles()
    {
      return $this->belongsTo('App\Role', 'roles_id', 'id');
    }

    public function departamento()
    {
      return $this->belongsTo('App\Models\Departamento', 'group_id', 'id');
    }

    public function personaluser()
    {
      return $this->hasOne('App\Models\Worker', 'user_id', 'id');
    }
}
