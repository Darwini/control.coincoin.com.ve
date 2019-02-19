<?php
namespace App\Http\Controllers\ControlPools;

//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, App\User;

class DecrepPool extends Controller
{
    //Real time, hash rate del pool
    public  static function realTime(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://dcr.suprnova.cc/index.php?page=api&action=getpoolstatus&api_key=b787d12dcaec1cc21bb4591eb2773c49e204822332ca87a5299050c4f8d518f3'
        );
        $response = json_decode($res->getBody()->getContents());

        $arr = array();
        $arr['hash']   = (int)substr($response->getpoolstatus->data->hashrate, 0, 6)/100;
        $arr['hash24'] = ((int)substr(($response->getpoolstatus->data->hashrate), 0, 6)/100)-100;
        $arr['hash24_u'] = 'MH/s';
        $arr['hash_u'] = 'MH/s';

        return response()->json(
            [  
                'msg'=>'hashrate',
                'datos'=>$arr,
                'code'=>200
            ],
        200);
    }

    //Hash rate del pool y de la red
    public static function poolHashrate(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://dcr.suprnova.cc/index.php?page=api&action=getpoolstatus&api_key=b787d12dcaec1cc21bb4591eb2773c49e204822332ca87a5299050c4f8d518f3');
        $response = json_decode($res->getBody()->getContents());

        $arr = array();
        $arr['hash_pool']   = (int)substr($response->getpoolstatus->data->hashrate, 0, 6)/100;
        $arr['hash_red']      = (int)substr(($response->getpoolstatus->data->nethashrate), 0, 6)/100;
        $arr['hash_pool_u'] = 'MH/s';
        $arr['hash_red_u'] = 'MH/s';

        return response()->json(
             ['msg'=>'poolHasrate',
              'datos'=> $arr,
             'code'=>200
             ],
            200);
    }

     //Network Status - dificultad de minado
    public static function dificultadRed(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://dcr.suprnova.cc/index.php?page=api&action=getdashboarddata&api_key=b787d12dcaec1cc21bb4591eb2773c49e204822332ca87a5299050c4f8d518f3');
        $response = json_decode($res->getBody()->getContents());
        $arr = [];

        $arr['diff'] = floatval(substr($response->getdashboarddata->data->network->difficulty, 0,6))/100; 
        $arr['diff_u'] = 'MH/s';
        $arr['next_diff'] = floatval(substr($response->getdashboarddata->data->network->nextdifficulty, 0,6))/100;
        $arr['next_diff_u'] = 'MH/s';

        echo response()->json(
             ['msg'=>'usuario',
              'datos'=> $arr,
              'code'=>200
             ],
            200);
    }

    //Mineros informacion de equivos activos-inactivos-totales
    public static function mineros(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://dcr.suprnova.cc/index.php?page=api&action=page=api&action=getuserworkers&api_key=b787d12dcaec1cc21bb4591eb2773c49e204822332ca87a5299050c4f8d518f3'
        );
  
        $response = json_decode($res->getBody()->getContents());
        $resp = $response;
        $active = 0;
        $inactive  = 0;
        $arr = [];

        foreach ($response->getuserworkers->data as $key => $value) {
            if ((int)$value->hashrate > 0){
                $active++;
            }else{
                $inactive++;
            }
        }
        $arr["workers_active"] = $active;
        $arr["workers_inactive"] = $inactive;
        $arr["workers_total"] = $active + $inactive;

        return response()->json(
             [
              'msg'=>'mineros',
              'datos'=>$arr,
              'code'=>200
             ],
            200);
    }

    public static function datosMineros(){
        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        $res = $client->request('GET', 'https://dcr.suprnova.cc/index.php?page=api&action=page=api&action=getuserworkers&api_key=b787d12dcaec1cc21bb4591eb2773c49e204822332ca87a5299050c4f8d518f3'
        );
  
  /*{
    "getuserworkers": {
        "version": "1.0.0",
        "runtime": 380.47194480896,
        "data": [{
            "id": 9739080,
            "username": "misaeboca.misal1",
            "password": "1234",
            "monitor": 0,
            "count_all": 0,
            "shares": 0,
            "hashrate": 0,
            "difficulty": 0
        }]
    }
}*/
        $response = json_decode($res->getBody()->getContents());
        $arr = array();
        foreach ($response->getuserworkers->data as $key => $mineros) {
            
            if($response->getuserworkers->runtime){
                $arr["ultima_conexion"] = $response->getuserworkers->runtime;
            }

            $datos   = (array) $mineros;

            foreach ($datos as $k => $v) {
                if($k == 'username'){
                     $arr["equipo"] = $v;
                }
                if($k == 'shares'){
                     $arr["tiempo_real"] = $v;
                }
                if($k == 'hashrate'){
                     $arr["diario"] = $v;
                     if((int) $v > 0){
                        $arr["status"] = 'ACTIVE';
                     }else{
                        $arr["status"] = 'INACTIVE';
                     }
                }
                if($k == 'count_all'){
                     $arr["aceptado"] = $v;
                }
            }

            $arr["rechazado"] = '0.0000';
            $arr["api"] = "DCR";
            $data["data"][] = $arr;

        }

    return response()->json(
            ['msg'=>'datos_minero',
                'datos'=> $data,
                'code'=>200
            ],
            200);
    }

    //Grfica del hashrate por usuario
    public static function grafica(){
        /*$client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://us-pool.api.btc.com/public/v1/pool/share-history/merge',
            [
                'query' => [
                    'dimension' => '1h',
                    //'start_ts' => '1519689846',
                    'count' => '24',
                    'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                    'puid'=> Auth::user()->puid,
                ]
            ]
        );



        $response = json_decode($res->getBody()->getContents());

        $categorias = array();
        $valores = array();
        */
        $hora_actual = date('H'); 
        $fecha_actual = date('Y-m-d '.$hora_actual.':00:00');

        $horas = [];
        for($i=0; $i<24; $i++){

            $horas[] = date('Y-m-d '.$hora_actual.':00:00');
        }
        echo $fecha_actual."<br>";
       // echo $hora_actual;

       /* foreach ($response->data->tickers as $key => $value) {

            foreach ($value as $k => $v) {
                if($k == 0){
                    $categorias[] =date('H:i', $v);
                }
                if($k == 1){
                    $valores[] = $v;
                }
            }
        }

        return response()->json(
            ['msg'=>'grafica',
                'datos'=> array("categorias"=>$categorias, "valores"=>$valores),
                'code'=>200
            ],
            200);*/
    }

    public static function precioDolar(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://siamining.com/api/v1/market');
        $response = (Array)json_decode($res->getBody()->getContents());
        if ($response)
            return  $response['usd_price'];
    }
}
