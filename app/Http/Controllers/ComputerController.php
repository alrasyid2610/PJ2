<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComputerStoreRequest;
use App\Http\Requests\ComputerUpdateRequest;
use App\Models\Computer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Computer::latest()->take(5)->get());
        // return "kocak";
        // return csrf_token();
        // return ;
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
    public function store(ComputerStoreRequest $request)
    {
        $data = $request->all();
        Computer::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil di insert'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function show(Computer $computer, Request $request)
    {
        return $request->id;
        return $computer->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function edit(Computer $computer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function update(ComputerUpdateRequest $request, Computer $computer)
    {
        // $pc_name = $computer->pc_name;
        $computer->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil di edit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Computer $computer)
    {
        $computer->delete();
        return "Data berhasil di delete";
    }
}
