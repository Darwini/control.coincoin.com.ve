<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alerts extends Model
{
    protected $table= 'alerts';
    
    protected $fillable= ['minero_id', 'minero_nombre', 'hash_1m', 'hash_15m', 'hash_1d', 'status'];
}
