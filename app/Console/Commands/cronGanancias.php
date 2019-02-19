<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CronGanancias extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronGanancias:cronganancias';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respaldo de las ganancias';
 
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
 
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('Inciando CronGanancias');

        $usuarios = DB::table('users')->get();

        foreach ($usuarios as $key => $user) {
            
            $cantGanancias = DB::table('ganancias')->where('puid', $user->puid)->count();

            $client = new \GuzzleHttp\Client(['http_errors' => false]);
            $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/account/earn-history',
                [
                    'query' => [
                        'page_size' => '1',
                        'page' => '1',
                        'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                        'puid'=>  $user->puid
                    ]
                ]
            );
            $response = json_decode($res->getBody()->getContents());
            $cant_api = $response->data->total_count;

            Log::info('Usuario '.$user->puid);

            if($cantGanancias == 0){ //No tiene registros en la tabla
                $this->llenarTodos($user->puid);
            }else if($cant_api > $cantGanancias){
                $this->llenarUltimos($user->puid, $cant_api, $cantGanancias);
            }

        }
    }

    public function llenarUltimos($user,$cant_api,$cantGanancias){
        $ultima_fecha = DB::table('ganancias')
                             ->select('date')
                             ->where('puid', $user)
                             ->orderBy('date', 'desc')
                             ->limit(1)->first();

        $total_paginas = ceil($cant_api / 50);

        for ($i=1; $i <= $total_paginas ; $i++) { 
            if($total_paginas == 1)
                $page_size = $cant_api-$cantGanancias;
            else
                $page_size = 50;


            $client = new \GuzzleHttp\Client(['http_errors' => false]);
            $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/account/earn-history',
                [
                    'query' => [
                        'page_size' => $page_size,
                        'page' => $i,
                        'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                        'puid'=>  $user
                    ]
                ]
            );

            $response = json_decode($res->getBody()->getContents());


            $datos_extra = array();
            $sw = 0;
                foreach ($response->data->list as $key => $value) {
                    $interno = [];
                    foreach ($value as $k => $v) {

                        if($k == "date"){
                           $ultima_fecha->date = str_replace("-", "", $ultima_fecha->date);
                           
                           if ($v == $ultima_fecha->date){
                                $sw = 1;
                                break;
                           }
                        }

                        if($k == "user_fpps_rate" or  $k == "more_than_pps96" or $k == "paid_amount_rate" or $k == "diff_rate" or $k == "earnings_rate")
                            continue;

                        if($k == "payment_time" and $v == 0){
                            $interno[$k] = NULL;
                        }else{

                            $interno[$k] = $v;  
                        }
                    }

                    if($sw == 1) break;
                    $interno["puid"] = $user; 
                    $datos_extra[] = $interno;
                }

                //print_r($datos);
                DB::table('ganancias')->insert($datos_extra);
                
        }

    }

    function llenarTodos($user){
        $client = new \GuzzleHttp\Client(['http_errors' => false]);

        $res = $client->request('GET', 'https://us-pool.api.btc.com/v1/account/earn-history',
            [
                'query' => [
                    'page_size' => '50',
                    'page' => '1',
                    'access_key'=>'TwQFZdNIsFSwD4DUPe7aDmXo77MZ3zhJze1rjTIG',
                    'puid'=>  $user
                ]
            ]
        );

        $response = json_decode($res->getBody()->getContents());
        $datos = array();
   
        //Recorro el resultado para saber cuantas paginas y armar el array insert
        foreach ($response->data->list as $key => $value) {

            $interno = [];
            foreach ($value as $k => $v) {

                if($k == "user_fpps_rate" or  $k == "more_than_pps96" or $k == "paid_amount_rate" or $k == "diff_rate" or $k == "earnings_rate")
                    continue;

                if($k == "payment_time" and $v == 0){
                    $interno[$k] = NULL;
                }else{

                    $interno[$k] = $v;  
                }
            }

            $interno["puid"] = $user; 
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
                            'puid'=>  $user
                        ]
                    ]
                );
                
                $response = json_decode($res->getBody()->getContents());
                $datos_extra = array();
                foreach ($response->data->list as $key => $value) {

                    $interno = [];
                    foreach ($value as $k => $v) {

                        if($k == "user_fpps_rate" or  $k == "more_than_pps96" or $k == "paid_amount_rate" or $k == "diff_rate" or $k == "earnings_rate")
                            continue;

                        if($k == "payment_time" and $v == 0){
                            $interno[$k] = NULL;
                        }else{

                            $interno[$k] = $v;  
                        }
                    }

                    $interno["puid"] = $user; 
                    $datos_extra[] = $interno;
                }
                DB::table('ganancias')->insert($datos_extra);
            }
        }

    }
}