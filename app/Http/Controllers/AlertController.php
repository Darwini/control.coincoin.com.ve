<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alerts;
use DB;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Alerts::where('minero_id', '<>', null)->distinct('minero_id')->orderBy('minero_id', 'desc')->get();
        foreach ($all as $al) {
            $allerts[$al->minero_id] = array('miner_id'=>$al->minero_id);
        }
        return response()->json(['ids'=>$allerts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alerts = Alerts::OrderBy('minero_id', 'desc')->GroupBy('id')->get();
        return View('installers.alerts.index', ['alerts' => $alerts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax() ) {
            
            $insert = Alerts::create([ 'minero_id' => $request->minero_id, 'minero_nombre' => $request->minero_nombre, 'hash_1m' => $request->hash_1m, 'hash_15m' => $request->hash_15m, 'hash_1d' => $request->hash_1d ]);
            
            return response()->json($insert);
        }
        else{
            return response()->json(0);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alerts = Alerts::where('minero_id', $id)->orderBy('created_at', 'desc')->take(10)->get();
        for($j = 0; $j < count($alerts); $j++) {
            $al[$alerts[$j]->minero_nombre][$j] = 
            array(
                'data_x'  => date_timestamp_get($alerts[$j]->created_at),
                'data_y'  => $alerts[$j]->hash_15m
            );
        }
        return response()->json([ 'alerts' => $al]);
    }

    public function ajaxshow(Request $request)
    {
        foreach($request->id as $id) {
            $alerts = Alerts::where('minero_id', $id)->orderBy('created_at', 'desc')->take(10)->get();

            for($j = 0; $j < count($alerts); $j++) {
                $al[$alerts[$j]->minero_nombre][$j] = 
                array(
                    'data_x'  => date_timestamp_get($alerts[$j]->created_at),
                    'data_y'  => $alerts[$j]->hash_15m//,
                    /*'data_y1' => $alerts[$j]->hash_1m,
                    'data_y2' => $alerts[$j]->hash_1d,*/
                );
            }
        }

        /*foreach ($request->id as $id) {
            $alerts = Alerts::where('minero_id', $id)->orderBy('created_at', 'desc')->take(10)->get();
            foreach ($alerts as $alert) {
                $al[$alert->id] = array(
                    'miner_id'  => $alert->minero_id,
                    'miner_name'=> $alert->minero_nombre,
                    'data_x'    => date_timestamp_get($alert->created_at),
                    'data_y'    => $alert->hash_15m,
                    'data_y1'   => $alert->hash_1m,
                    'data_y2'   => $alert->hash_1d
                );
            }
        }*/
        return response()->json(['alerts' => $al]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
