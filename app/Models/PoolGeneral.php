<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use  App\Models\SiaPool;
use  App\Models\BtcPool;

class PoolGeneral extends Model
{
    //Real time
    public static function realTime(){
        switch (Auth::user()->pool) {
        	case 'BTC':
                BtcPool::realtime();
        		break;
        	case 'SIA':
        		SiaPool::realtime();
        		break;
        	default:
        		# code...
        		break;
        }
      
    }
}
