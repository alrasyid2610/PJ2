<?php

namespace App\Http\Controllers;

use App\Events\ComputerUserCreated;
use App\Http\Requests\StoreInputStockOpnameRequest;
use App\Models\UserComputer;
use App\Http\Requests\StoreUserComputerRequest;
use App\Http\Requests\UpdateUserComputerRequest;
use App\Models\Computer;
use App\Models\userHasComputers;
use Illuminate\Support\Facades\DB;

class UserComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return csrf_token();
        // return "kocak";
        return UserComputer::get()->toJson();
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
     * @param  \App\Http\Requests\StoreUserComputerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserComputerRequest $request)
    {
        // return $request->all();
        UserComputer::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil di insert'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserComputer  $userComputer
     * @return \Illuminate\Http\Response
     */
    public function show(UserComputer $userComputer)
    {
        return $userComputer->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserComputer  $userComputer
     * @return \Illuminate\Http\Response
     */
    public function edit(UserComputer $userComputer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserComputerRequest  $request
     * @param  \App\Models\UserComputer  $userComputer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserComputerRequest $request, UserComputer $userComputer)
    {
        $userComputer->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil di update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserComputer  $userComputer
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserComputer $userComputer)
    {
        $userComputer->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil di delete'
        ]);
    }

    public function storeInputStockOpname(StoreInputStockOpnameRequest $request)
    {
        // dd($request->only(['section.name']));

        $user = [];
        $user['id_section'] = $request->section['code'];
        $user['section'] = $request->section['name'];
        $user['name'] = $request->name;
        $user['location'] = $request->location['name'];
        $user['email'] = $request->email;

        // dd($user);


        // Data Computer
        $computer = [];
        $computer['pc_name'] = $request->pc_name;
        $computer['processor'] = $request->processor['code'];
        $computer['os'] = $request->os['code'];
        $computer['ram'] = $request->ram;
        $computer['hdd'] = $request->hdd;
        $computer['ip'] = $request->ip;
        $computer['ms_office'] = $request->ms_office['code'];
        $antivirus = '';
        $antivirus_length = count($request->antivirus);
        foreach ($request->antivirus as $index => $value) {
            // dd($index);
            if($index == ($antivirus_length - 1)) {
                $antivirus .= $value['code'];
            } else {
                $antivirus .= $value['code'] . "|";
            }
        }
        $computer['wsus'] = $request->wsus;
        $computer['user_login'] = $request->user_login;
        $computer['brand'] = $request->brand['code'];
        $computer['usage_type'] = $request->usage_type['code'];

        DB::transaction(function () use ($computer, $user) {
            // $data_user = DB::table('user_computers')->insert($user);
            $data_user = UserComputer::create($user);
            $data_computer = Computer::create($computer);

            DB::table('user_has_computers')->insert([
                'id_user' => $data_user->id,
                'id_computer' => $data_computer->id,
                'name' => $user['name'],
                'pc_name' => $computer['pc_name'],
                'section' => $user['section'],
                'location' => $user['location'],
            ]);


            //  DB::table('user_computers')
            //     ->where('id', 71)
            //     ->update(
            //         ['name' => "tuginem"]
            //     );
        });

        // $computer = Computer::latest()->take(5)->get()->toJson();
        $computer = Computer::get()->toJson();
        ComputerUserCreated::dispatch($computer);


        return response()->json([
            'message' => "Berhasil Input"
        ]);
    }
}
