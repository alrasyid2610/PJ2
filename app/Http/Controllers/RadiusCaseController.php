<?php

namespace App\Http\Controllers;

use App\Models\RadiusCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RadiusCaseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a = RadiusCase::get();
        return response()->json($a);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\RadiusCase  $radiusCase
     * @return \Illuminate\Http\Response
     */
    public function show(RadiusCase $radiusCase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RadiusCase  $radiusCase
     * @return \Illuminate\Http\Response
     */
    public function edit(RadiusCase $radiusCase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RadiusCase  $radiusCase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RadiusCase $radiusCase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RadiusCase  $radiusCase
     * @return \Illuminate\Http\Response
     */
    public function destroy(RadiusCase $radiusCase)
    {
        //
    }

    public function getCasePerDay(Request $request)
    {
        if(isset($request->day)) {
            $data = DB::connection('mysql')->select("SELECT case_name, count(case_name) as 'jumlah' FROM radius_error_histories WHERE date BETWEEN DATE_FORMAT(NOW() - INTERVAL $request->day DAY, '%Y-%m-%d') AND NOW() GROUP BY case_name");
            return $data;
        } else {
            $data = DB::connection('mysql')->select("SELECT case_name, count(case_name) as 'jumlah' FROM radius_error_histories WHERE date BETWEEN DATE_FORMAT(NOW() - INTERVAL 0 DAY, '%Y-%m-%d') AND NOW() GROUP BY case_name");
            return response()->json($data);
        }
    }
}
