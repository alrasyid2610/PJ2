<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{

    protected function check_expired($expired_date, $count_day_to_expired, $mail, $license_name) {
        // return "anjing";
        // $date_expired=date_create("2022-12-28");
        $diff=date_diff(date_create($expired_date),date_create(date_create()->format("Y-m-d")))->format("%R%a");
        $result = [
            "expired" => (int)$diff >= ((int)("-" . $count_day_to_expired)),
            "sisa_hari" => (int)$diff,
            "pengecekan_expired" => $count_day_to_expired
        ];


        if($result['expired'] == true) {
            $pesan = "License $license_name akan expired " . $result['sisa_hari'] . " hari lagi. Segera lakukan perpanjangan";
            // $mail->index($pesan);
        }

        return $result;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $mail = new TestMailController;

        $data = License::get();
        // $data_expired2 = collect([]);
        $index = 0;
        $data_expired = $data->map(function ($item, $key) {
            $mail = new TestMailController;
            return collect($item)->merge($this->check_expired($item->expired_date, $item->check_expired, $mail, $item->license_name));
        });

        return $data_expired;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = License::create($request->data);
        return response()->json(['message' => 'Data Berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function show(License $license)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, License $license)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $license)
    {
        //
    }
}
