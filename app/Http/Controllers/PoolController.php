<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use  App\Models\SiaPool;
use  App\Models\BtcPool;
use  App\Models\DecrepPool;
use  App\Models\BchPool;

class PoolController extends Controller
{
    //Real time
    public static function realTime(){
        switch (strtoupper(Auth::user()->pool)) {
            case 'BTC':
                return BtcPool::realtime();
                break;
            case 'BCH':
                return BchPool::realtime();
                break;
            case 'DCR': //decrep
                return DecrepPool::realtime();
                break;
            default:
                break;
        }
    }

    //Hash rate bdel Pool y de la red 
    public static function poolHashrate(){
         switch (strtoupper(Auth::user()->pool)) {
            case 'BTC':
                return BtcPool::poolHashrate();
                break;
            case 'BCH':
                return BchPool::poolHashrate();
                break;
            case 'DCR':
                return DecrepPool::poolHashrate();
                break;
            default:
                break;
        }
    }

    //Network Status -- dificultad de la red
    public static function dificultadRed(){
         switch (strtoupper(Auth::user()->pool)) {
            case 'BTC':
                return BtcPool::dificultadRed();
                break;
            case 'BCH':
                return BchPool::dificultadRed();
                break;
            case 'SIA':
                return DecrepPool::dificultadRed();
                break;
            default:
                break;
        }
    }

    //Mineros activos-inactivos-totales
    public static function mineros(){
         switch (strtoupper(Auth::user()->pool)) {
            case 'BTC':
                return BtcPool::mineros();
                break;
            case 'BCH':
                return BchPool::mineros();
                break;
            case 'SIA':
                return DecrepPool::mineros();
                break;
            default:
                break;
        }
    }

    //Ganancias hiy, 7 - 30 dias, pagado, pendiente, total minado, balance y fecha de ultimo pago
    public static function ganancias(){
         switch (strtoupper(Auth::user()->pool)) {
            case 'BTC': 
                return BtcPool::ganancias();
                break;
            case 'BCH': 
                return BchPool::ganancias();
                break;
            case 'DCR': //decrep
                return DecrepPool::ganancias();
                break;
            default:
                break;
        }
    }

    //Grafica de hash rate
    public static function grafica(){
         switch (strtoupper(Auth::user()->pool)) {
            case 'BTC': 
                return BtcPool::grafica();
                break;
            case 'BCH': 
                return BchPool::grafica();
                break;
            case 'DCR': //decrep
                return DecrepPool::grafica();
                break;
            default:
                break;
        }
    }

    //Datos mineros
    public static function datosMineros(){
         switch (strtoupper(Auth::user()->pool)) {
            case 'BTC': 
                return BtcPool::datosMineros();
            case 'BCH':
                return BchPool::datosMineros();
                break;
            case 'DCR': //decrep
                return DecrepPool::datosMineros();
                break;
            default:
                break;
        }
    }

    //Historial de ganancias
    public static function historialGanancias(){
         switch (strtoupper(Auth::user()->pool)) {
            case 'BTC': 
                return BtcPool::historialGanancias();
            case 'BCH':
                return BchPool::historialGanancias();
                break;
            case 'DCR': //decrep
                return DecrepPool::historialGanancias();
                break;
            default:
                break;
        }
    }

    //Ganancias ultimo mes
    public static function gananciasUltimoMes(){
         switch (strtoupper(Auth::user()->pool)) {
            case 'BTC': 
                return BtcPool::gananciasUltimoMes();
            case 'BCH':
                return BchPool::gananciasUltimoMes();
                break;
            case 'DCR': //decrep
                return DecrepPool::gananciasUltimoMes();
                break;
            default:
                break;
        }
    }
    //Ganancias mes
    public static function gananciasMes(){
         switch (strtoupper(Auth::user()->pool)) {
            case 'BTC': 
                return BtcPool::gananciasMes();
            case 'BCH':
                return BchPool::gananciasMes();
                break;
            case 'DCR': //decrep
                return DecrepPool::gananciasMes();
                break;
            default:
                break;
        }
    }
}