<?php 
namespace App;
 
//use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\Model;
 
class Role extends Model
{
	protected $table="roles";
	//protected $primaryKey = 'id';
	protected $fillable=['name','display_name','descripcion'];


	public function useroles()
	{
		return $this->hasMany('App\User', 'roles_id', 'id');
	}
}