<?php
namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SiaPool extends Model
{
    //Real time, hash rate del pool
    public  static function realTime(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://siastats.info/dbs/pools_reported_hashrate.json'
        );
        $response = json_decode($res->getBody()->getContents());
        $total = count($response);

        $i=0;
        $ayer = strtotime ( '-1 day' , strtotime ( date('Y-m-j') ) ) ;
        $ayer = date ( 'Y-m-d' , $ayer );
        $arra = array();

        foreach ($response as $key => $object) {
            $fecha = date("Y-m-d", substr($object->time, 0, 10));

            if($fecha == $ayer){
                $arr["hash24"] = (int)substr($object->siamining, 0, 4)/100;
                $arr["hash24_u"] = 'TH/s';
                $arr["network"] =  (int)substr($object->network, 0, 4)/100;
                $arr["difficulty"] =  (int)substr($object->difficulty, 0, 4)/100;
            }
            if(date("Y-m-d") == $fecha){
                $arr["hash"] = (int)substr($object->siamining, 0, 4)/100;
                $arr["hash_u"] = 'TH/s';
                $arr["network"] = (int)substr($object->network, 0, 4)/100;
                $arr["difficulty"] =  (int)substr($object->difficulty, 0, 4)/100;
            }
        }
     
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
        $res = $client->request('GET', 'https://siastats.info/dbs/hashratesRT.json');
        $response = json_decode($res->getBody()->getContents());

        $arr = array();
        foreach ($response as $key => $object) {
            if($object->siamining){
                $arr["hash_pool"] =  (int)substr($object->siamining, 0, 4)/100;
                $arr["hash_pool_u"] = 'TH/s';
            }
            if($object->network){
                $arr["hash_red"] =  (int)substr($object->network, 0, 4)/100;
                $arr["hash_red_u"] = 'PH/s';
            }
        }
            
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
        $res = $client->request('GET', 'https://siamining.com/api/v1/network');
        $response = json_decode($res->getBody()->getContents());
        $arr = [];

        foreach ($response as $key => $value) {
            if($key == 'difficulty'){
                $arr['diff'] = floatval(substr($value, 0,4))/100;
                $arr['diff_u'] = 'TH/s';
            }
            if($key == 'next_difficulty'){
                $arr['next_diff'] = floatval(substr($value, 0,4))/100;
                $arr['next_diff_u'] = 'TH/s';
                break;
            }
        }
        return response()->json(
             ['msg'=>'usuario',
              'datos'=> $arr,
              'code'=>200
             ],
            200);
    }

    //Mineros informacion de equivos activos-inactivos-totales
    public static function mineros(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://siamining.com/api/v1/addresses/c96a7add93f515dec753208772c627f1cdb0e0de0cf137f002c40b506eb9ae3c4a433d736403/workers'
        );
  
        $response = json_decode($res->getBody()->getContents());
        $resp = (array)($response);
        $active = 0;
        $inactive  = 0;
        $arr = [];

        foreach ($resp as $key => $value) {
            foreach ($value->intervals as $k => $v) {
                if((int)$v->hash_rate > 0){
                    $active++;
                }else{
                    $inactive++;
                }
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

    //Ganancias
    public static function ganancias(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://siamining.com/api/v1/addresses/e4b572eea1a5a2a30baffcaea196fb6915a3d983e0f84bcd9c8fc8fdf47eac3e7576fde231ad/summary');

        $response = (array)json_decode($res->getBody()->getContents());
        $arr = [];
        $dolar = self::precioDolar();

        //Total pagado
        $arr['total_paid'] =  bcdiv($response['paid'], '1', 2);
        $arr['total_paid_dolar'] =  money_format('%.2n', $response['paid'] * $dolar);

        //Estimado hoy
        $arr['earnings_today'] =  bcdiv($response['intervals'][3]->rewards, '1', 2);
        $arr['earnings_today_dolar'] = money_format('%.2n', $response['intervals'][3]->rewards*$dolar); 

        //balance
        $arr['pending_payouts'] = bcdiv($response['balance'], '1', 2);
        $arr['pending_payouts_dolar'] = money_format('%.2n', $response['balance']*$dolar);   

        //Pendiente por pagar
        $arr['unpaid'] = bcdiv(($arr['pending_payouts'] + $arr['earnings_today']), '1', 2);
        $arr['unpaid_dolar'] = money_format('%.2n', $arr['pending_payouts_dolar'] + $arr['earnings_today_dolar']);

        //Estimados
        $arr['estimado_7d'] = bcdiv($arr['earnings_today'] *7, '1', 2);
        $arr['estimado_7d_dolar'] =  money_format('%.2n', $arr['earnings_today_dolar'] *7);
        $arr['estimado_30d'] = bcdiv($arr['earnings_today'] *30, '1', 2);
        $arr['estimado_30d_dolar'] =  money_format('%.2n', $arr['earnings_today_dolar'] *30);
        $arr['total_minado'] = bcdiv(($arr['total_paid'] + $arr['earnings_today'] + $arr['unpaid']) *30, '1', 2);
        $arr['total_minado_dolar'] =  money_format('%.2n', ($arr['total_paid_dolar'] + $arr['earnings_today_dolar'] + $arr['unpaid_dolar']));
        $arr['current_coin'] = 'SC';

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://siamining.com/api/v1/addresses/e4b572eea1a5a2a30baffcaea196fb6915a3d983e0f84bcd9c8fc8fdf47eac3e7576fde231ad/payouts');

        $response = (array)json_decode($res->getBody()->getContents());
        $arr['last_payment_time'] = $response[0]->time; 
     
        //"last_payment_time" : 14111 microtime

        return response()->json(
             ['msg'=>'ganancias',
              'datos'=>$arr,
              'code'=>200
             ],
            200);
    }

    //Grafica 
    public static function grafica(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://siamining.com/api/v1/addresses/e4b572eea1a5a2a30baffcaea196fb6915a3d983e0f84bcd9c8fc8fdf47eac3e7576fde231ad/hashrate-history');

        $response = (array)json_decode($res->getBody()->getContents());
        $categorias = array();
        $valores = array();
        $hora = '';

        //$response= arsort($res);  //ordeno desde la ultima hora hacia atras
        $hoy  = date('Y-m-d');
        $ayer = strtotime ( '-1  day' , strtotime ( $hoy ) ) ;
        $ayer = date ( 'Y-m-j' , $ayer );

        foreach ($response as $key => $value) {
            foreach ($value as $k => $v) {
                //me traigo el hashrate de ayer u hoy para completar los ultimos 24 h
                if( (date('Y-m-d') == date('Y-m-d', $value[0])) ||  $ayer == date('Y-m-d', $value[0])){
                    $hora1 = date('H', $value[0]);
                    if( $hora1 !=  $hora){
                        $hora1 = date('H', $value[0]);
                        $hora =  (string)date('H', $value[0]);
                        $categorias[] = date('Y-m-d H:i', $value[0]);
                        $valores[]    = $value[1];
                    }
                }
            }
        }


        $categorias = array_reverse($categorias, true);
        $valores    = array_reverse($valores, true);
        $categorias = array_slice($categorias, 0, 24);
        $valores    = array_slice($valores, 0, 24);
        $categorias = array_reverse($categorias, true);
        $valores    = array_reverse($valores, 0, 24);

        return response()->json(
            ['msg'=>'grafica',
                'datos'=> array("categorias"=>$categorias, "valores"=>$valores),
                'code'=>200
            ],
            200);
    }

    public static function precioDolar(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://siamining.com/api/v1/market');
        $response = (Array)json_decode($res->getBody()->getContents());
        if ($response)
            return  $response['usd_price'];
    }
}
