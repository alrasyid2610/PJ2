<?php

namespace App\Http\Controllers;

use App\Models\RadiusCase;
use Illuminate\Http\Request;

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
}
