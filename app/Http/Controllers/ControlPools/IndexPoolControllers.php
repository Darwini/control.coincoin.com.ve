<?php

namespace App\Http\Controllers\ControlPools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, App\User;
use App\Http\Controllers\ControlPools\BtcPool; 
use App\Http\Controllers\ControlPools\BchPool;
use App\Http\Controllers\ControlPools\DecrepPool;

class IndexPoolControllers extends Controller
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

	public function mineros()
    {   //$users=User::where('puid','<>','')->where('group_id','6')->get();
		$users=User::where('puid','<>','')->get();
        $url = self::url();
        $access_key = self::access_key();
		$client = new \GuzzleHttp\Client();
        $d=[];
        $more=[];
		foreach ($users as $user) {
			$resp = $client->request('GET', 'http://'.$url.'-pool.api.btc.com/v1/worker/',
                ['query' => [
                    'access_key'=>$access_key,
                    'puid'=> $user->puid,
                    'page_size'=>50,
                    'page'=>1,
                    'order_by'=>'worker_name',
                    'status'=>'active'
                    ]
                ]
            );

	        $responsem=json_decode($resp->getBody()->getContents());
	        if (!empty($responsem->data->data) ){
                $total_pagina=$responsem->data->page_count;
                for ($j=0; $j < count($responsem->data->data); $j++){
                    $d[$user->username][$j]=array(
                        'user'=>$user->username,
                        'mineros_id'=>$responsem->data->data[$j]->worker_id,
                        'mineros_nombre'=>$responsem->data->data[$j]->worker_name,
                        'hash_1m'=>$responsem->data->data[$j]->shares_1m,
                        'hash_15m'=>$responsem->data->data[$j]->shares_15m,
                        'hash_1d'=>$responsem->data->data[$j]->shares_1d,
                        'unidad_fuerza'=>$responsem->data->data[$j]->shares_unit,
                        'unidad_fuerza_1d'=>$responsem->data->data[$j]->shares_1d_unit
                    );

                    if ($total_pagina > 1) {
                        $respp = $client->request('GET', 'http://'.$url.'-pool.api.btc.com/v1/worker/',[
                            'query' => [ 
                                'access_key'=>$access_key,
                                'puid'=> $user->puid,
                                'page_size'=>50,
                                'page'=> 2,
                                'order_by'=>'worker_id',
                                'status'=>'active'] 
                            ]
                        );

                        $respuesta=json_decode($respp->getBody()->getContents());
                        if (!empty($respuesta->data->data)) {
                            for ($j=0; $j<count($respuesta->data->data); $j++) { 
                                array_push($d[$user->username], [
                                    'user'=>$user->username,
                                    'mineros_id'=>$respuesta->data->data[$j]->worker_id,
                                    'mineros_nombre'=>$respuesta->data->data[$j]->worker_name,
                                    'hash_1m'=>$respuesta->data->data[$j]->shares_1m,
                                    'hash_15m'=>$respuesta->data->data[$j]->shares_15m,
                                    'hash_1d'=>$respuesta->data->data[$j]->shares_1d,
                                    'unidad_fuerza'=>$respuesta->data->data[$j]->shares_unit,
                                    'unidad_fuerza_1d'=>$respuesta->data->data[$j]->shares_1d_unit
                                ]);
                            }
                        }
                    }
                }
	        }
        }
        return response()->json(['datos'=>$d]);
        //return response()->json([$responsem]);
	}

    public static function UserMiner(Request $request){
        $user=User::where('puid', $request->puid)->get();
        switch (strtoupper($user[0]->pool)) {
            case 'BTC':
                return BtcPool::mineros($user[0]->puid);
            break;
            
            case 'BCH':
                return BchPool::mineros($user[0]->puid);
            break;
            
            case 'SIA':
                return DecrepPool::mineros($user[0]->puid);
            break;
        }
    }


    public function usuarios()
    {
        $users=User::where('puid','<>','')->where('group_id','6')->get();
        $client = new \GuzzleHttp\Client();
        $res=[];
        //for ($i=0; $i < count($users); $i++) {
            //$res[$i] = $client->request('GET', 'http://us-pool.api.btc.com/v1/account/info',
            $res/*[$i]*/ = $client->request('GET', 'http://us-pool.api.btc.com/v1/account/sub-account/list',
                [
                'query' => [
                    'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                    'puid'=> 142922,//$users[$i]->puid,
                    ]
                ]
            );

            $response=json_decode($res->getBody()->getContents());
        //}

        $datos=[];
        foreach ($response->data as $variable) {
            for ($i=0; $i<count($response->data); $i++) {
                $puid=$response->data[$i]->puid;

                $mineros = new \GuzzleHttp\Client();
                $resp = $mineros->request('GET', 'http://us-pool.api.btc.com/v1/worker/',
                    [
                    'query' => [
                        'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                        'puid'=> $puid,
                        ]
                    ]
                );
  
                $responsem = json_decode($resp->getBody()->getContents());
                $arr = [];  
                if (!empty($responsem->data->data) ) {
                    foreach ($responsem->data->data as $keys){
                        for ($j=0; $j < count($responsem->data->data); $j++) {
                            $datos[$puid]= array('puid' => $response->data[$i]->puid,'moneda_tipo'=> $response->data[$i]->coin_type, 'usuario'=>$response->data[$i]->name);

                            $d[$j]= array('mineros_nombre' => $responsem->data->data[$j]->worker_name, 'mineros_id'=>$responsem->data->data[$j]->worker_id);
                        }
                    }
                }
            }
        }

        return response()->json(
            [
                'msg'=>'Usuario',
                //'datos'=>$response->data,
                'datoz'=>$datos,
                //'datos'=>$res,
                'code'=>200
            ],
            200);
    }
}