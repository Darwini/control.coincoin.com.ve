<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class BTController extends Controller
{
    //Real time - hash del pool
    public  function realTime(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/realtime/hashrate',
            [
            'query' => [
                'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                'puid'=> Auth::user()->puid                ]
            ]
        );
  
        $response = json_decode($res->getBody()->getContents());

        return response()->json(
             ['msg'=>'hashrate',
              'datos'=>$response->data,
             'code'=>200
             ],
            200);
    }

    //Mineros  Real-time stats
    public function mineros(Request $request){
        $client = new \GuzzleHttp\Client();
    
        https://us-bccpool.api.btc.com/v1/worker/groups?page_size=20&access_key=TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG&puid=195659&lang=en
        $res = $client->request('GET', 'http://us-pool.api.btc.com/v1/worker/stats',
            [
            'query' => [
                'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                'puid'=>  Auth::user()->puid,
                ]
            ]
        );
  
        $response = json_decode($res->getBody()->getContents());

        return response()->json(
             [
              'msg'=>'mineros',
              'datos'=>$response->data,
              'code'=>200
             ],
            200);
    }

    //Ganancias GET /account/earn-stats
    public function gananciasHoy(){
        $client = new \GuzzleHttp\Client();

        $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/account/earn-stats',
            [
            'query' => [
                'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                'puid'=> Auth::user()->puid,
                'page'=>'1',
                'page_size'=>'2'
                ]
            ]
        );
  
        $response = json_decode($res->getBody()->getContents());
        //"total_paid": 5356111,   total_pagado
        //"earnings_today": 188552,     estimado hoy
        //"unpaid": 188552--Balance
        //"earnings_yesterday" : 204322   ayer
        //"pending_payouts" : 0
        //"last_payment_time" : 14111 microtime

        return response()->json(
             ['msg'=>'ganancias',
              'datos'=>$response->data,
              'code'=>200
             ],
            200);
    }

    public function gananciasHoyUpdate(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/account/earn-stats',
            [
            'query' => [
                'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                'puid'=> Auth::user()->puid,
                'page'=>'1',
                'page_size'=>'2'
                ]
            ]
        );
  
        $response = json_decode($res->getBody()->getContents());
        //"total_paid": 5356111,   total_pagado
        //"earnings_today": 188552,     estimado hoy
        //"unpaid": 188552--Balance
        //"earnings_yesterday" : 204322   ayer
        //"pending_payouts" : 0
        //"last_payment_time" : 14111 microtime

        return $response->data;
    }

    //Poll GET /account/earn-stats
    public function poolHasrate(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/pool/multi-coin-stats',
            [
            'query' => [
                'dimension' => '1h'
                ]
            ]
        );
        $response = json_decode($res->getBody()->getContents());

        return response()->json(
             ['msg'=>'poolHasrate',
              'datos'=> $response->data,
             'code'=>200
             ],
            200);
    }
     //Poll GET /account/earn-stats
    public function usuario(){
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/account/info',
                [
                'query' => [
                    'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                    'puid'=> Auth::user()->puid,
                    ]
                ]
            );
            $response = json_decode($res->getBody()->getContents());

        return response()->json(
             ['msg'=>'usuario',
              'datos'=> $response->data,
              'code'=>200
             ],
            200);
    }


    //Network status
    public function networkStatus(){

            $client = new \GuzzleHttp\Client();

            $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/coins-income',
                [
                'query' => [
                    'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                'puid'=>   Auth::user()->puid,
                    ]
                ]
            );
      
            $response = json_decode($res->getBody()->getContents());


        return response()->json(
             ['msg'=>'usuario',
              'datos'=> $response->data,
              'code'=>200
             ],
            200);
    }

    public function grafica(){
        $client = new \GuzzleHttp\Client();
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

        foreach ($response->data->tickers as $key => $value) {

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
            200);
    }

    public function datosMineros(){
        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/worker/',
            [
                'query' => [
                    'group' => '-1',
                    'page' ==   '1',
                    'page_size' => '50',
                    'status' => 'all',
                    'order_by' => 'worker_name',
                    'asc' => '1',
                    //'start_ts' => '1519689846',
                    //'count' => '100',
                    'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                    'puid'=> Auth::user()->puid
                ]
            ]
        );
  
        $response = json_decode($res->getBody()->getContents());
        $data =  array();
        
        foreach ($response->data->data as $key => $mineros) {
            $arr = array();

            foreach ($mineros as $k => $v) {
                if($k == "worker_name")
                    $arr["equipo"] = $v;

                if($k == "shares_1m")
                    $arr["tiempo_real"] = $v;

                if($k == "shares_1d")
                    $arr["diario"] = $v;

                if($k == "accept_count"){
                    $mil = $v;
                    //$seconds = ($mil / 1000);
                    $arr["aceptado"] =  $v;
                }

                if($k == "reject_percent")
                    $arr["rechazado"] = $v;

                if($k == "last_share_time")
                    $arr["ultima_conexion"] = date('Y-m-d H:i AM', $v);

                if($k == "status")
                    $arr["estatus"] = $v;
            }

            $data["data"][] = $arr;
        }


    return response()->json(
            ['msg'=>'datos_minero',
                'datos'=> $data,
                'code'=>200
            ],
            200);
    //return view('layouts.mineros.index',compact('data'));

    }

    public function historialGanancias(){
        //temporal mientras termino el cron
        $result = DB::table('ganancias')
                        ->where('puid',Auth::user()->puid)
                        ->delete();
     
        $cantGanancias = DB::table('ganancias')->where('puid', Auth::user()->puid)->count();

        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/account/earn-history',
            [
                'query' => [
                    'page_size' => '1',
                    'page' => '1',
                    'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                    'puid'=>  Auth::user()->puid
                ]
            ]
        );


        $response = json_decode($res->getBody()->getContents());
        $cant_api = $response->data->total_count;
        //No tiene datos la tablas
        if($cantGanancias == 0){
            $this->llenarTabla();
            $this->updateUltimo($response);

        }elseif($cant_api > $cantGanancias){
            $this->llenarUltimos($cant_api, $cantGanancias);
        }else{
            //Actualizo los ultimos dos datos
            $this->updateUltimo($response);
        }

        //Consulto la tabla llena y devuelvo el array

        $resultado = DB::table('ganancias')
                     ->select('*')
                     ->where('puid',  Auth::user()->puid)
                     ->orderBy('id', 'desc')
                     ->get();

         return response()->json(
            ['msg'=>'datos_ganancia',
                'datos'=> $resultado,
                'code'=>200
            ],
            200);
    }

    function llenarTabla(){
        $client = new \GuzzleHttp\Client(['http_errors' => false]);

        $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/account/earn-history',
            [
                'query' => [
                    'page_size' => '50',
                    'page' => '1',
                    'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                    'puid'=>  Auth::user()->puid
                ]
            ]
        );

        $response = json_decode($res->getBody()->getContents());
        $datos = array();

        //Recorro el resultado para saber cuantas paginas y armar el array insert
        $campos = array('date', 'earnings', 'payment_time', 'payment_tx', 'address' ,'paid_amount', 'stats', 'diff', 'payment_mode', 'puid');
        
        //Recorro el resultado para saber cuantas paginas y armar el array insert
        foreach ($response->data->list as $key => $value) {
            $interno = [];
            $fecha   = "";
            foreach ($value as $k => $v) {

                if(in_array($k, $campos)){
                    if($k == "date"){
                        $fecha = $v;
                    }
                    if($k == "payment_time" and $v == 0){
                        $interno[$k] = NULL;
                    }else{
                        $interno[$k] = $v;  
                    }
                }
            }

            $interno["puid"] =  Auth::user()->puid;
            $fecha = DB::table('ganancias')
                             ->select('date')
                             ->where('puid', Auth::user()->puid)
                             ->where(DB::raw("to_char(date, 'YYYYMMDD')", $fecha))
                             ->count();
            if($fecha == 0)
                DB::table('ganancias')->insert($interno);

        }

        //Envio el resto de las paginas si son mas de 1
        if($response->data->page_count > 1){
            for ($i=2; $i <= $response->data->page_count ; $i++) { 

                $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/account/earn-history',
                    [
                        'query' => [
                            'page_size' => '50',
                            'page' => $i,
                            'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                            'puid'=>  Auth::user()->puid
                        ]
                    ]
                );
                
                $response = json_decode($res->getBody()->getContents());
                $datos_extra = array();
                
                foreach ($response->data->list as $key => $value) {

                    $interno = [];
                    $fecha   = "";
                    foreach ($value as $k => $v) {
        
                        if(in_array($k, $campos)){
                            if($k == "date"){
                                $fecha = $v;
                            }
                            if($k == "payment_time" and $v == 0){
                                $interno[$k] = NULL;
                            }else{
                                $interno[$k] = $v;  
                            }
                        }
                    }
        
                    $interno["puid"] =  Auth::user()->puid;
                    $fecha = DB::table('ganancias') 
                                     ->select('date')
                                     ->where('puid', Auth::user()->puid)
                                     ->where(DB::raw("to_char(date,'YYYYMMDD')", $fecha))
                                     ->count();
                    if($fecha == 0)
                        DB::table('ganancias')->insert($interno);

                } 
               //DB::table('ganancias')->insert($datos_extra);
            }
        }

    }

    function eliminarGanancias($puid_id){
        $result = DB::table('ganancias')
                ->where('puid', $puid_id)
                ->delete();
            if($result){
                 return response()->json(
                    ['msg'=>'Eliminados con exito',
                        'code'=>200
                    ],
                    200);
            }else{
                 return response()->json(
                    ['msg'=>'Fallo al eliminar',
                        'code'=>500
                    ],
                    500);
            }


    }
    function llenarUltimos($cant_api, $cantGanancias){
        $ultima_fecha = DB::table('ganancias')
                             ->select(DB::raw("to_char(date, 'YYYYMMDD') as date"))
                             ->where('puid', Auth::user()->puid)
                             ->whereNotNull('date')
                             ->orderBy('date', 'desc')
                             ->first();

        $cantidad = $cant_api - $cantGanancias;
        $total_paginas = ceil( $cantidad / 50);
     
        for ($i=1; $i <= $total_paginas ; $i++) { 
            if($total_paginas == 1)
                $page_size = 50;
            else
                $page_size = 50;


            $client = new \GuzzleHttp\Client(['http_errors' => false]);
            $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/account/earn-history',
                [
                    'query' => [
                        'page_size' => $page_size,
                        'page' => $i,
                        'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                        'puid'=>  Auth::user()->puid
                    ]
                ]
            );

            $response = json_decode($res->getBody()->getContents());
            //Recorro el resultado para saber cuantas paginas y armar el array insert
            $campos = array('date', 'earnings', 'payment_time', 'payment_tx', 'address' ,'paid_amount', 'stats', 'diff', 'payment_mode', 'puid');
        
            $datos_extra = array();
            $sw = 0;
                foreach ($response->data->list as $key => $value) {
                    $interno = [];
                    $fecha = "";
                    foreach ($value as $k => $v) {
                        if(in_array($k, $campos)){
                            if($k == "date"){
                                $fecha = $v;
                                if ($v == $ultima_fecha->date){
                                    $sw = 1;
                                    break;
                                }
                            }
                            if($k == "payment_time" and $v == 0){
                                $interno[$k] = NULL;
                            }else{
                                $interno[$k] = $v;  
                            }
                        }
                    }
                    $interno["puid"] = Auth::user()->puid;
                    $regi = DB::table('ganancias')
                                        ->select('date')
                                        ->where('puid', Auth::user()->puid)
                                        ->where(DB::raw("to_char(date, 'YYYYMMDD')", $fecha))
                                        ->exists();
                    if(!$regi){
                        DB::table('ganancias')->insert($interno);
                    }

                    if($sw == 1){
                        break;
                    }

                }//Fin for
        }

    }

    //Revisar que debe actualizar todos los datos que el pago esten pendientes
    function updateUltimo($response){
        $datos_extra = array();
        $sw = 0;
        $i = 0;

        $ultima_fecha = DB::table('ganancias')
                             ->select(DB::raw("to_char(date, 'YYYYMMDD') as date"))
                             ->where('puid', Auth::user()->puid)
                             ->orderBy('date', 'desc')
                             ->limit(1)->first();
   
        $datos_keys = array('date','earnings', 'diff','payment_time', 'address', 'stats');

        foreach ($response->data->list as $key => $value) {
            $interno = [];
            $fecha = '';
            foreach ($value as $k => $v) {
                if(in_array($k, $datos_keys)){
                    $interno[$k] = $v;  
                    if($k == "date"){
                        $fecha = $v;
                        if($v == $ultima_fecha->date){
                            $sw = 1;
                        }
                    }
                    if($k == "payment_time" and $v == 0)
                        $interno[$k] = NULL;
                }

            }

            if($sw == 1){
                $arr = array('last_payment_time', 'earnings_today');
                $ele = $this->gananciasHoyUpdate();

                foreach ($ele as $i => $val) {
                    if(in_array($i, $arr)){
                        if($i == 'last_payment_time' &&  $val !='')
                            $interno['payment_time'] = date('Y-m-d H:i:s', $val);
                        
                        if($i == 'earnings_today')
                            $interno['earnings'] =  $val;
                    }
                }


                $puid = Auth::user()->puid;
                DB::select("update ganancias set payment_time='".$interno['payment_time']."', earnings=".$interno['earnings']." where puid='".Auth::user()->puid."' AND to_char(date, 'YYYYMMDD')='".$fecha."'");
                /*DB::table('ganancias')
                ->where('puid' , Auth::user()->puid)
                ->where(DB::raw("to_char(date, 'YYYYMMDD')", $fecha))
                ->update($interno);*/
                break;
            }
         
        }//Fin for

        
    }

    public function gananciasMes(){
        $datos = DB::table('ganancias')
        ->select(DB::raw("EXTRACT(YEAR FROM date)||' '||to_char(     
                    date_trunc('month', date), 'Month') as date,
                    sum(earnings::int) earnings, 
                    sum(paid_amount::int)  paid_amount,
                    SUBSTR(sum(diff::float)::text,1,2)::float/10  diff,
                    EXTRACT(YEAR FROM date) as anio,
                    to_char(date, 'MM') as nro_mes,
                    EXTRACT(YEAR FROM date) as anio,
                    to_char(date_trunc('month', date), 'Month') as mes,
                    ganancias.puid,
                    max(date) date2,
                    max(payment_time) as payment_time,
                    address"))
        ->where('address', '<>', '')
        ->where('puid', Auth::user()->puid)
        ->groupBy(DB::raw("ganancias.puid,
                    EXTRACT(YEAR FROM date)||' '||to_char(date_trunc('month', date), 'Month'),
                    EXTRACT(YEAR FROM date), 
                    to_char(date, 'MM'),
                    EXTRACT(MONTH FROM date),
                    to_char(date_trunc('month', date), 'Month'),
                    address"))
        ->orderBy('anio', 'desc')
        ->orderBy("nro_mes", 'desc')
        ->get();

        if(count($datos) == 0){
            //fecha, dificultad, ganancia, cambio, payment_time, payment_tx, address,stats 
            return response()->json(
                ['msg'=>'datos_mes',
                    'datos'=> 0,
                    'code'=>200
                ],
                200);
        }else{
            $data = [];
            foreach ($datos as $key => $value) {
                $arr = array();
                foreach ($value as $k => $v) {
                    $arr[$k] = $v;
                    
                }
                $data[] = $arr;
            }

            //fecha, dificultad, ganancia, cambio, payment_time, payment_tx, address,stats 
            return response()->json(
                ['msg'=>'datos_mes',
                    'datos'=> $data,
                    'code'=>200
                ],
                200);
        }

        
    }
    public function gananciasUltimoMes(){
        $datos = DB::table('ganancias')
        ->select(DB::raw("EXTRACT(YEAR FROM date)||' '||to_char(date_trunc('month', date), 'Month') as date,
                    sum(earnings::int) earnings, 
                    sum(paid_amount::int)  paid_amount,
                    EXTRACT(YEAR FROM date) as anio,
                    to_char(date, 'MM') as nro_mes,
                    EXTRACT(YEAR FROM date) as anio,
                    to_char(date_trunc('month', date), 'Month') as mes,
                    ganancias.puid,
                    users.porcentaje, 
                    users.deduccion"))
        ->join('users', 'users.puid', '=', 'ganancias.puid')
        ->where('address', '<>', '')
        ->where('ganancias.puid', Auth::user()->puid)
        ->groupBy(DB::raw("ganancias.puid,
                    EXTRACT(YEAR FROM date)||' '||to_char(date_trunc('month', date), 'Month'),
                    EXTRACT(YEAR FROM date), 
                    to_char(date, 'MM'),
                    EXTRACT(MONTH FROM date),
                    to_char(date_trunc('month', date), 'Month'), deduccion, porcentaje"))
        ->orderBy('anio', 'desc')
        ->orderBy("nro_mes", 'desc')
        ->limit(1)
        ->get();

        $arr = array();
        foreach ($datos as $key => $value) {
            foreach ($value as $k => $v) {
                $arr[$k] = $v;
            }
            $arr;
        }

        //fecha, dificultad, ganancia, cambio, payment_time, payment_tx, address,stats 
        if(count($arr) > 0){
            return response()->json(
                ['msg'=>'datos_mes',
                    'datos'=> $arr,
                    'code'=>200
                ],
                200);
        }else{
            return response()->json(
                ['msg'=>'datos_mes',
                    'datos'=> 0,
                    'code'=>200
                ],
                200);
        }
    }

}