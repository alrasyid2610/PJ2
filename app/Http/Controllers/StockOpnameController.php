<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ComputerUserCreated;
use App\Http\Requests\StoreInputStockOpnameRequest;
use App\Models\UserComputer;
use App\Models\Computer;
use App\Models\User;
use App\Models\userHasComputers;
use App\Models\UserHasComputers as ModelsUserHasComputers;
use Illuminate\Support\Facades\DB;

class StockOpnameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userHasComputer = UserHasComputers::latest()->take(5)->get();
        // return "kocak";
        return $userHasComputer;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userHasComputer = UserHasComputers::first()->where('id', $id)->get();
        $computer = Computer::where('id', $userHasComputer[0]->id_computer)->get();
        $user = UserComputer::where('id', $userHasComputer[0]->id_user)->get();

        return response()->json([$computer,$user, $userHasComputer]);
        // return UserHasComputers::where('id', $id)->get();
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
        $user = collect($request->user)->except(['id', 'created_at', 'updated_at', 'sectionArray']);
        // return response()->json($user->toArray());
        // $user['id_section'] = $request->user['section']['code'];
        // $user['section'] = $request->user['section']['name'];

        $computer = collect($request->computer)->except(['status_fix_asset', 'id', 'created_at', 'updated_at']);
        $computer['antivirus'] = '';
        foreach ($request->computer['antivirus'] as $key => $value) {
            if((count($request->computer['antivirus']) - 1) == $key) {
                $computer['antivirus'] .= $value['name'];
            } else {
                $computer['antivirus'] .= $value['name'] . "|";
            }
        }


        $user_has_computer = collect($request->user_has_computer)->except(['created_at', 'updated_at']);
        $user_has_computer['section'] = $user['section'];
        // return $computer;


        DB::transaction(function () use ($request, $computer, $user, $user_has_computer) {
            Computer::where('id', $request->computer['id'])->update($computer->toArray());
            UserComputer::where('id', $request->user['id'])->update($user->toArray());
            userHasComputers::where('id', $request->user_has_computer['id'])->update($user_has_computer->toArray());
        });

        return response()->json([
            'success'   => true,
            'message'   => 'Data updated successfully',
            'data'      => 'Data Success Input'
        ]);
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

    public function store(StoreInputStockOpnameRequest $request)
    {
        // return response()->json($request->computer['keterangan']);
        // dd($request->only(['section.name']));



        // DATA USER
        $user = collect($request->user)->except('sectionArray');
        // $user = $request->user;
        // $user['id_section'] = $request->user['section']['code'];
        // $user['section'] = $request->user['section']['name'];

        // DATA COMPUTER
        $computer = collect($request->computer)->except(['status_fix_asset']);
        $computer['antivirus'] = '';
        foreach ($request->computer['antivirus'] as $key => $value) {
            if((count($request->computer['antivirus']) - 1) == $key) {
                $computer['antivirus'] .= $value['name'];
            } else {
                $computer['antivirus'] .= $value['name'] . "|";
            }
        }

        DB::transaction(function () use ($computer, $user) {
            // $data_user = DB::table('user_computers')->insert($user);
            $data_user = UserComputer::create($user->toArray());
            $data_computer = Computer::create($computer->toArray());

            $user_computer = [
                'id_user' => $data_user->id,
                'id_computer' => $data_computer->id,
                'name' => $user['name'],
                'pc_name' => $computer['pc_name'],
                'section' => $user['section'],
                'location' => $user['factory'],
            ];
            UserHasComputers::create($user_computer);
            // DB::table('user_has_computers')->insert();
        });

        // $computer = UserHasComputers::latest()->take(5)->get()->toJson();
        // ComputerUserCreated::dispatch($computer);


        return response()->json([
            'success'   => true,
            'message'   => 'Data entered successfully',
            'data'      => 'Data Success Input'
        ]);
    }

    public function getData() {
        $computer = Computer::get()->groupBy('location');

        // dd($computer['KRW']->count());
    }
}
