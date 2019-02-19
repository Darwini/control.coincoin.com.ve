<?php
namespace App\Http\Controllers\ControlPools;

//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, App\User;

class BtcPool extends Controller
{
    public static function url() {
        if (Auth::user()->url_pool == 'USA'){
            return 'us';
        }else{
            return 'eu';
        }
    }

    public static function access_key() {
        if (Auth::user()->url_pool == 'USA'){
            return 'WgJF25ZlHfCO9sMLM5TiiUbgjCJrCks6CNSCSdCG';
        }else{
            return 'vUegP1H0IoC3hHNi7tiE1wuChZ3pJWWNYh22v10R';
        }
    }

    //Mineros informacion de equipos activos-inactivos-totales
    public static function mineros($puid){
        $user=User::where('puid', $puid)->get();
        $url = self::url();
        $access_key = self::access_key();
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'http://'.$url.'-pool.api.btc.com/v1/worker/',
            [
                'query' =>
                [
                    'access_key'=>$access_key,
                    'puid'=>  $user[0]->puid,
                    'page_size'=>50,
                    'page'=>1,
                    'order_by'=>'worker_id', 
                    'status'=>'active' 
                ],
            ]
        );

        $resp=$client->request('GET', 'http://'.$url.'-pool.api.btc.com/v1/worker/stats',
            [ 'query'=> [ 'access_key'=>$access_key, 'puid'=> $user[0]->puid ] ]
        );

        $respuesta=json_decode($res->getBody()->getContents());
        $response=json_decode($resp->getBody()->getContents());
        $arr = [];
        if (!empty($respuesta->data->data) ){
            $total_pagina=$respuesta->data->page_count;
            for ($j=0; $j<count($respuesta->data->data); $j++){
                $d[$user[0]->puid][$j]=
                array(
                    'mineros_id'=>$respuesta->data->data[$j]->worker_id, 
                    'mineros_nombre' => $respuesta->data->data[$j]->worker_name, 
                    'hash_1m'=>$respuesta->data->data[$j]->shares_1m, 
                    'hash_15m'=>$respuesta->data->data[$j]->shares_15m, 
                    'hash_1d'=>$respuesta->data->data[$j]->shares_1d, 
                    'unidad_fuerza'=>$respuesta->data->data[$j]->shares_unit, 
                    'unidad_fuerza_1d'=>$respuesta->data->data[$j]->shares_1d_unit, 
                    'status'=>$respuesta->data->data[$j]->status, 
                );
            }
            
            if ($total_pagina > 1) {
                $resp3 = $client->request('GET', 'http://'.$url.'-pool.api.btc.com/v1/worker/', 
                    ['query' => 
                        [ 
                        'access_key'=>$access_key,
                        'puid'=> $user[0]->puid,
                        'page_size'=>50,
                        'page'=>2, 
                        'order_by'=>'worker_id',
                        'status'=>'active'
                        ] 
                    ]
                );
                        
                $respo=json_decode($resp3->getBody()->getContents());
                if (!empty($respo->data->data)) {
                    for ($k=0; $k<count($respo->data->data); $k++){
                        array_push($d[$user[0]->puid], [
                            'mineros_id'=>$respo->data->data[$k]->worker_id, 
                            'mineros_nombre' => $respo->data->data[$k]->worker_name, 
                            'hash_1m'=>$respo->data->data[$k]->shares_1m, 
                            'hash_15m'=>$respo->data->data[$k]->shares_15m, 
                            'hash_1d'=>$respo->data->data[$k]->shares_1d, 
                            'unidad_fuerza'=>$respo->data->data[$k]->shares_unit, 
                            'unidad_fuerza_1d'=>$respo->data->data[$k]->shares_1d_unit, 
                            'status'=>$respo->data->data[$k]->status
                        ]);
                    }
                }
            }

            if ($total_pagina > 2) {
                $resp3 = $client->request('GET', 'http://'.$url.'-pool.api.btc.com/v1/worker/', 
                    ['query' => 
                        [ 
                        'access_key'=>$access_key,
                        'puid'=> $user[0]->puid,
                        'page_size'=>50,
                        'page'=>3, 
                        'order_by'=>'worker_id',
                        'status'=>'active'
                        ] 
                    ]
                );
                        
                $respo=json_decode($resp3->getBody()->getContents());
                if (!empty($respo->data->data)) {
                    for ($k=0; $k<count($respo->data->data); $k++){
                        array_push($d[$user[0]->puid], [
                            'mineros_id'=>$respo->data->data[$k]->worker_id, 
                            'mineros_nombre' => $respo->data->data[$k]->worker_name, 
                            'hash_1m'=>$respo->data->data[$k]->shares_1m, 
                            'hash_15m'=>$respo->data->data[$k]->shares_15m, 
                            'hash_1d'=>$respo->data->data[$k]->shares_1d, 
                            'unidad_fuerza'=>$respo->data->data[$k]->shares_unit, 
                            'unidad_fuerza_1d'=>$respo->data->data[$k]->shares_1d_unit, 
                            'status'=>$respo->data->data[$k]->status
                        ]);
                    }
                }
            }

            if ($total_pagina > 3) {
                $resp3 = $client->request('GET', 'http://'.$url.'-pool.api.btc.com/v1/worker/', 
                    ['query' => 
                        [ 
                        'access_key'=>$access_key,
                        'puid'=> $user[0]->puid,
                        'page_size'=>50,
                        'page'=>4, 
                        'order_by'=>'worker_id',
                        'status'=>'active'
                        ] 
                    ]
                );
                        
                $respo=json_decode($resp3->getBody()->getContents());
                if (!empty($respo->data->data)) {
                    for ($k=0; $k<count($respo->data->data); $k++){
                        array_push($d[$user[0]->puid], [
                            'mineros_id'=>$respo->data->data[$k]->worker_id, 
                            'mineros_nombre' => $respo->data->data[$k]->worker_name, 
                            'hash_1m'=>$respo->data->data[$k]->shares_1m, 
                            'hash_15m'=>$respo->data->data[$k]->shares_15m, 
                            'hash_1d'=>$respo->data->data[$k]->shares_1d, 
                            'unidad_fuerza'=>$respo->data->data[$k]->shares_unit, 
                            'unidad_fuerza_1d'=>$respo->data->data[$k]->shares_1d_unit, 
                            'status'=>$respo->data->data[$k]->status
                        ]);
                    }
                }
            }

            if ($total_pagina > 4) {
                $resp3 = $client->request('GET', 'http://'.$url.'-pool.api.btc.com/v1/worker/', 
                    ['query' => 
                        [ 
                        'access_key'=>$access_key,
                        'puid'=> $user[0]->puid,
                        'page_size'=>50,
                        'page'=>5, 
                        'order_by'=>'worker_id',
                        'status'=>'active'
                        ] 
                    ]
                );
                        
                $respo=json_decode($resp3->getBody()->getContents());
                if (!empty($respo->data->data)) {
                    for ($k=0; $k<count($respo->data->data); $k++){
                        array_push($d[$user[0]->puid], [
                            'mineros_id'=>$respo->data->data[$k]->worker_id, 
                            'mineros_nombre' => $respo->data->data[$k]->worker_name, 
                            'hash_1m'=>$respo->data->data[$k]->shares_1m, 
                            'hash_15m'=>$respo->data->data[$k]->shares_15m, 
                            'hash_1d'=>$respo->data->data[$k]->shares_1d, 
                            'unidad_fuerza'=>$respo->data->data[$k]->shares_unit, 
                            'unidad_fuerza_1d'=>$respo->data->data[$k]->shares_1d_unit, 
                            'status'=>$respo->data->data[$k]->status
                        ]);
                    }
                }
            }
        }
        
        $arr[$user[0]->puid]=array('mineros_activos'=>$response->data->workers_active,'mineros_total'=>$response->data->workers_total,'mineros_dead'=>$response->data->workers_dead);


        if (isset($d)) {
            return response()->json(['datos'=>$d,'masdatos'=>$arr, 'pgtotal'=>$total_pagina]);
        }
        else{
            //No Hay Datos; Los Equipos se han desconectado
            return response()->json(['datos'=>0]);
            //return response()->json(['datos'=>$respuesta, 'paginas'=>$respuesta->data->total_count]);
        }
    }
    
    public static function precioDolar(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD,EUR&e=Coinbase&extraParams=your_app_name');
        $response = (Array)json_decode($res->getBody()->getContents());
        if ($response)
            return  $response['USD'];
    }
}
