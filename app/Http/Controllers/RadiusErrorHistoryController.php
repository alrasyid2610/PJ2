<?php

namespace App\Http\Controllers;

use App\Models\RadiusErrorHistories;
use Illuminate\Http\Request;

class RadiusErrorHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return response()->json(['nama' => "harun"]);
        // RadiusErrorHistories::where()-?
        return response()->json(RadiusErrorHistories::get());
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
        $a = $request->all();
        RadiusErrorHistories::insert($a);
        return response()->json(["message" => "Data Berhasil ditambahkan"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RadiusErrorHistory  $radiusErrorHistory
     * @return \Illuminate\Http\Response
     */
    public function show(RadiusErrorHistories $radiusErrorHistories)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RadiusErrorHistory  $radiusErrorHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(RadiusErrorHistories $radiusErrorHistories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RadiusErrorHistory  $radiusErrorHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RadiusErrorHistories $radiusErrorHistories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RadiusErrorHistory  $radiusErrorHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(RadiusErrorHistories $radiusErrorHistories)
    {
        //
    }
}
