<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\RadiusCaseController;
use App\Http\Controllers\RadiusErrorHistoryController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\UserComputerController;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/cekcek', function() {
    $a = DB::connection('PMPG')->select("select TOP 1 a.Barcode, a.ContainerDescription, d.JobNumber, e.AutoCountNumber, a.TxnDateTime, b.ItemId as 'Scan'
,b.OriginalAmount, b.CurrentAmount
,case
        when b.IsActive = 0 then 'Non Active'
        when b.IsActive = 1 then 'Active'
        else '-'
end as 'Status'
,c.ChangeSeq, c.[Name], c.ChangeDateTime, c.ProcessedDateTime, c.StatusCode
from TxnSkid a
left join MaterialItem b on a.Barcode=b.ItemId and a.LocationId = 0
left join ImporterChange c on a.TxnSkidId=c.Id
inner join Job d on a.JobId=d.JobId
inner join AutoCount e on a.AutoCountId=e.AutoCountId
where a.Barcode = 'PLG10005381885'
order by c.ChangeSeq desc");
    // dd(collect($a)->toJson());

    return response()->json(collect($a)->toArray());
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/test', function() {
    return response()->json(
        DB::table('computers')
            ->join('user_has_computers','computers.id', '=', 'user_has_computers.id_computer')
            ->select('computers.*', 'user_has_computers.*')
            ->get()
    );
});
Route::resource('stock-opname', StockOpnameController::class);
Route::resource('computer', ComputerController::class);
Route::get('computer/getComputerPlant/site/{plant?}', [ComputerController::class, 'getComputerPlant']);
Route::resource('userComputer', UserComputerController::class);
Route::resource('/stock-opname', StockOpnameController::class);
Route::resource('/li', StockOpnameController::class);
Route::resource('/license', LicenseController::class);
Route::get('/getRadiusCase/getCasePerDay', [RadiusCaseController::class, 'getCasePerDay']);
Route::resource('/radiusCase', RadiusCaseController::class);
Route::resource('/radiusErrorHistory', RadiusErrorHistoryController::class);
Route::resource('/networkDNP', NetworkController::class);
// Route::apiResources()

Route::get("/test22", function() {
    // Excel::download(collect(["data"]), 'users.xlsx');
});
