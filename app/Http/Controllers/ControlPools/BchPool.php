<?php
namespace App\Http\Controllers\ControlPools;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, App\User;

class BchPool extends Controller
{
    public static function url() {
        if (Auth::user()->url_pool=='USA'){
            return 'us';
        }else{
            return 'eu';
        }
    }

    public static function access_key() {
        if (Auth::user()->url_pool == 'USA'){
            return 'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG';
        }else{
            return 'Cuou7HVCNQCqWLhmLs1gs9QSWu816cUpyUZvJO78';
        }
    }
    
    

    //Mineros informacion de equivos activos-inactivos-totales
    public static function mineros($puid){
        $url = self::url();
        $access_key = self::access_key();

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://'.$url.'-bccpool.api.btc.com/v1/worker/',
            [   'query' =>
                [
                    'page' => '1',
                    'page_size' => '50',
                    'status' => 'active',
                    'order_by' => 'worker_id',
                    'access_key'=>$access_key,
                    'puid'=> $puid,
                ]
            ]
        );
  
        $response = json_decode($res->getBody()->getContents());
        $arr = [];
        return response()->json( ['datosbcc'=>$response->data] );

        foreach ($response->data->list[0] as $key => $value) {
            if($key == 'workers_active'){
                $arr['workers_active'] = $value;
            }
            if($key == 'workers_inactive'){
                $arr['workers_inactive'] = $value;
            }
            if($key == 'workers_total'){
                $arr['workers_total'] = $value;
            }
        }
        
    }

    public static function datosMineros(){
        $url = self::url();
        $access_key = self::access_key();

        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        $res = $client->request('GET', 'https://'.$url.'-bccpool.api.btc.com/v1/worker/',
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
                    'access_key'=>$access_key,
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

                $arr["api"] = "BTC";
                $arr["current_coin"] = "BHC";
            }

            $data["data"][] = $arr;
        }

        return response()->json(
            ['msg'=>'datos_minero',
                'datos'=> $data,
                'code'=>200
            ],
            200);
    }

    //Grafica de hashrate del pool
    public static function grafica(){
        $url = self::url();
        $access_key = self::access_key();

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://'.$url.'-bccpool.api.btc.com/public/v1/pool/share-history/merge',
            [
                'query' => [
                    'dimension' => '1h',
                    //'start_ts' => '1519689846',
                    'count' => '24',
                    'access_key'=> $access_key,
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

    public static function ganancias(){
        $url = self::url();
        $access_key = self::access_key();

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://'.$url.'-bccpool.api.btc.com/v1/account/earn-stats',
            [
            'query' => [
                'access_key'=>$access_key,
                'puid'=> Auth::user()->puid,
                'page'=>'1',
                'page_size'=>'2'
                ]
            ]
        );

        $response = json_decode($res->getBody()->getContents());
        $arr = [];
        $dolar = self::precioDolar();

        //debo poner el current_coin o moneda a la que se refiere
        //Total pagado
        $arr['total_paid'] = round(($response->data->total_paid*0.00000001), 8);
        $arr['total_paid_dolar'] = round(($response->data->total_paid*0.00000001)*$dolar, 2);

        //Pendiente por pago
        if($response->data->pending_payouts == 0){
            $arr['pending_payouts'] = '0.00000000';
            $arr['pending_payouts_dolar'] = '0.00';
        }else{
            $arr['pending_payouts'] = round(($response->data->pending_payouts*0.00000001), 8);
            $arr['pending_payouts_dolar'] = round(($response->data->pending_payouts*0.00000001)*$dolar, 2);
        }

        //Estimado hoy
        $arr['earnings_today'] = round(($response->data->earnings_today*0.00000001), 8);
        $arr['earnings_today_dolar'] = round(($response->data->earnings_today*0.00000001)*$dolar, 2);

        //Unpaid
        $arr['unpaid'] = round(($response->data->unpaid*0.00000001), 8);
        $arr['unpaid_dolar'] = round(($response->data->unpaid*0.00000001)*$dolar, 2);

        //Ul timo pago
        $arr['last_payment_time'] = $date = date('d-m-Y H:i:s A', $response->data->last_payment_time);

        $arr['estimado_7d'] = round($arr['earnings_today'] *7, 8);
        $arr['estimado_7d_dolar'] = round($arr['earnings_today_dolar'] *7, 2);
        $arr['estimado_30d'] = round($arr['earnings_today'] *30, 8);
        $arr['estimado_30d_dolar'] = round($arr['earnings_today_dolar'] *30, 2);
        $arr['total_minando'] = round(($arr['total_paid'] + $arr['earnings_today'] + $arr['unpaid']), 8);
        $arr['total_minando_dolar'] = round(($arr['total_paid_dolar'] + $arr['earnings_today_dolar'] + $arr['unpaid_dolar']), 2);
        $arr["current_coin"] = "BHC";
        //"total_paid": 5356111,   total_pagado
        //"earnings_today": 188552,     estimado hoy
        //"unpaid": 188552--Balance
        //"pending_payouts" : 0
        //"last_payment_time" : 14111 microtime

        return response()->json(
             ['msg'=>'ganancias',
              'datos'=>$arr,
              'code'=>200
             ],
            200);
    }
    //Ganancias del cliente
    public static function historialGanancias(){
        //temporal mientras termino el cron
        $url = self::url();
         $access_key = self::access_key();

        $result = DB::table('ganancias')
                        ->where('puid',Auth::user()->puid)
                        ->delete();
     
        $cantGanancias = DB::table('ganancias')->where('puid', Auth::user()->puid)->count();

        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        $res = $client->request('GET', 'https://'.$url.'-bccpool.api.btc.com/v1/account/earn-history',
            [
                'query' => [
                    'page_size' => '1',
                    'page' => '1',
                    'reason' => '1', 
                    'access_key'=> $access_key,
                    'puid'=>  Auth::user()->puid
                ]
            ]
        );


        $response = json_decode($res->getBody()->getContents());
        $cant_api = $response->data->total_count;
        //No tiene datos la tablas
        if($cantGanancias == 0){
            self::llenarTabla();
            self::updateUltimo($response);

        }elseif($cant_api > $cantGanancias){
            self::llenarUltimos($cant_api, $cantGanancias);
        }else{
            //Actualizo los ultimos dos datos
            self::updateUltimo($response);
        }

        //Consulto la tabla llena y devuelvo el array

        $resultado = DB::table('ganancias')
                     ->select('*')
                     ->where('puid',  Auth::user()->puid)
                     ->orderBy('id', 'desc')
                     ->get();

        $dolar = self::precioDolar();
        $interno =  array();
        $arr = array();

        foreach ($resultado as $key => $value) {
            $ganancia  = 0;
            $address = '';
            $time = '';
            foreach ($value as $k => $v) {
                
                if($k == 'address'){
                    $arr[$k] = $v;
                    $address = $v;
                }
                if($k == 'payment_time'){
                    $time == $v;
                    $arr[$k] = $v;
                }
                if($k == 'earnings'){
                    $arr[$k] = round(($v * 0.00000001), 8);
                    $arr['earnings_dolar'] = round((($v * 0.00000001) * $dolar), 2);
                    $arr['current_coin'] = 'BCH';
                    $ganancia = $arr[$k];
                }else if($k == 'stats'){
                    if($v == 'PENDING_NOT_ENOUGH' or $address == ''){
                        $arr['status'] = 'Pendiente';
                    }else if ($ganancia == 0 ) {
                        $arr['status'] = 'Inactivo';
                    }else{
                        $arr['status'] = 'Pagado';
                    }

                }else{
                    $arr[$k] = $v;
                }
            }
            $interno[] = $arr;
        }

        return response()->json(
            ['msg'=>'datos_ganancia',
                'datos'=> $interno,
                'code'=>200
            ],
            200);
    }

    public static function  llenarTabla(){
        $url = self::url();
        $access_key = self::access_key();

        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        $res = $client->request('GET', 'https://'.$url.'-bccpool.api.btc.com/v1/account/earn-history',
            [
                'query' => [
                    'page_size' => '50',
                    'page' => '1',
                    'access_key'=>$access_key,
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
                $interno["current_coin"] = "BHC";
            }

            $interno["puid"] =  Auth::user()->puid;
            $fecha = DB::table('ganancias')
                             ->select('date')
                             ->where('puid', Auth::user()->puid)
                             ->where(DB::raw("to_char(date, 'YYYYMMDD')", $fecha))
                             ->count();
            if($fecha == 0){
                DB::table('ganancias')->insert($interno);
            }

        }

        //Envio el resto de las paginas si son mas de 1
        if($response->data->page_count > 1){
            for ($i=2; $i <= $response->data->page_count ; $i++) { 

                $res = $client->request('GET', 'https://'.$url.'-bccpool.api.btc.com/v1/account/earn-history',
                    [
                        'query' => [
                            'page_size' => '50',
                            'page' => $i,
                            'access_key'=>$access_key,
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
                        $interno["current_coin"] = "BHC";
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

    public static function llenarUltimos($cant_api, $cantGanancias){
        $url = self::url();
        $access_key = self::access_key();

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
            $res = $client->request('GET', 'https://'.$url.'-bccpool.api.btc.com/v1/account/earn-history',
                [
                    'query' => [
                        'page_size' => $page_size,
                        'page' => $i,
                        'access_key'=> $access_key,
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
                        $interno["current_coin"] = "BHC";
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
    public static function updateUltimo($response){
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
                $ele =  self::gananciasHoyUpdate();

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

    public static function gananciasHoyUpdate(){
        $url = self::url();
        $access_key = self::access_key();

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://'.$url.'-bccpool.api.btc.com/v1/account/earn-stats',
            [
            'query' => [
                'access_key'=> $access_key,
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

    public static function gananciasMes(){
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
                    (select address from ganancias where puid = '195659' order by payment_time desc limit 1)
                    , current_coin"))
        ->where('address', '<>', '')
        ->where('puid', Auth::user()->puid)
        ->groupBy(DB::raw("ganancias.puid,
                    EXTRACT(YEAR FROM date)||' '||to_char(date_trunc('month', date), 'Month'),
                    EXTRACT(YEAR FROM date), 
                    to_char(date, 'MM'),
                    EXTRACT(MONTH FROM date),
                    to_char(date_trunc('month', date), 'Month'),
                    current_coin"))
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
            $arr = array();
            $dolar = self::precioDolar();
            $anio = '';
            $mes = '';

            foreach ($datos as $key => $value) {
                foreach ($value as $k => $v) {
                    if($k == 'earnings'){
                        $arr[$k] = ($v * 0.00000001);
                        $arr['earnings_dolar'] = round((($v * 0.00000001) * $dolar), 2);
                    }else{
                        $arr[$k] = $v;
                    }
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
    public static function gananciasUltimoMes(){
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
                    users.deduccion, current_coin"))
        ->join('users', 'users.puid', '=', 'ganancias.puid')
        ->where('address', '<>', '')
        ->where('ganancias.puid', Auth::user()->puid)
        ->groupBy(DB::raw("ganancias.puid,
                    EXTRACT(YEAR FROM date)||' '||to_char(date_trunc('month', date), 'Month'),
                    EXTRACT(YEAR FROM date), 
                    to_char(date, 'MM'),
                    EXTRACT(MONTH FROM date),
                    to_char(date_trunc('month', date), 'Month'), deduccion, porcentaje, current_coin"))
        ->orderBy('anio', 'desc')
        ->orderBy("nro_mes", 'desc')
        ->limit(1)
        ->get();

        $arr = array();
        $dolar = self::precioDolar();
        $btc_dolar = self::precioBTC();

        foreach ($datos as $key => $value) {
            foreach ($value as $k => $v) {
                if($k == 'earnings'){
                    $arr['earnings'] = ($v * 0.00000001);
                    $arr['earnings_dolar'] = round((($v * 0.00000001) * $dolar), 2);
                }else{
                    $arr[$k] = $v;
                }
            }

        }


        $arr['btc_precio'] = $btc_dolar;
        $arr['coin_precio'] = $dolar;
        $arr['current_coin'] = 'BCH';
        $ganancias = 0;

        if(isset($datos[0]->earnings)){
            $ganancias = (int)$datos[0]->earnings;
        }
        //fecha, dificultad, ganancia, cambio, payment_time, payment_tx, address,stats 
        if(count($arr) > 0  && $ganancias > 0){
                
            if($arr['porcentaje'] == 0 && $arr['deduccion'] == 0){
                $arr['pagar_dolar'] = 0;
                $arr['pagar_coin'] = 0 * 0.00000001;
            }
            if((int)$arr['porcentaje'] > 0){
                $ganancias = $arr['earnings_dolar'];
                $resto = $ganancias - ($ganancias * (int)$arr['porcentaje'])/100;
                $pagar =  $ganancias - $resto;
                $arr['pagar_dolar'] = round($pagar, 2);
                $arr['pagar_coin'] =  round(($pagar / $dolar), 8);
            }
            if((int)$arr['deduccion'] > 0){
                $ganancias = $arr['earnings_dolar'];
                $deduccion = (int)$arr['deduccion'] / $dolar;
                $arr['pagar_dolar']  = (int)$arr['deduccion'];
                $arr['pagar_coin'] = $deduccion * 0.00000001;
            }
            return response()->json(
                ['msg'=>'datos_mes',
                    'datos'=> $arr,
                    'code'=>200
                ],
                200);
        }else{
            //Revisar las personas que comienzan a minar, esto debe hacerlo el cron
            $arr['earnings'] = 0 * 0.00000001;
            $arr['earnings_dolar'] = 0;
            $arr['pagar_dolar']  = 0;
            $arr['pagar_coin'] = 0 * 0.00000001;

            return response()->json(
                ['msg'=>'datos_mes',
                    'datos'=> $arr,
                    'code'=>200
                ],
                200);
        }
    }
    public static function precioDolar(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://min-api.cryptocompare.com/data/price?fsym=BCH&tsyms=BTC,USD,EUR');
        $response = (Array)json_decode($res->getBody()->getContents());
        if ($response)
            return  $response['USD'];
    }
    public static function precioBTC(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=BTC,USD,EUR');
        $response = (Array)json_decode($res->getBody()->getContents());
        if ($response)
            return  $response['USD'];
    }
}
