<?php

namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // SELECT JSON_QUERY(attr, '$') FROM networks;
        // return ;
        // return DB::select("SELECT JSON_EXTRACT(attr, '$') AS 'data' FROM networks")[0]->data;
        $dataTemp = DB::select("SELECT nu.*, nd.*, nd.attr AS attrNd, n.* FROM network_uses AS nu, network_device AS nd, networks AS n WHERE nu.network_device_id = nd.id AND nu.network_id = n.id");
        return $dataTemp[0];
        // return $dataTemp[0]->attr;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Network  $network
     * @return \Illuminate\Http\Response
     */
    public function show(Network $network)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Network  $network
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Network $network)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Network  $network
     * @return \Illuminate\Http\Response
     */
    public function destroy(Network $network)
    {
        //
    }
}
