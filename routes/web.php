<?php

use App\Events\ComputerUserCreated;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\TestMailController;
use App\Models\UserComputer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Stevebauman\Wmi\wmi as Wmi;




// Script untuk connect ke DB Radius

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('wmi', function () {
    $wmi = new Wmi($host = '172.16.128.3', $username = 'administrator', $password = 'edpdnp');
    $objRefresher = new COM("WbemScripting.Swbemrefresher");
    if($connection = $wmi->connect('root\\cimv2')) {
        echo "Cool! We're connected. <br>";
        $query = $wmi->getConnection()->newQuery();
        $results = $query->from('Win32_PerfFormattedData_PerfProc_Process')
        ->get();
        foreach ($results as $d) {
            echo $d->Name ." " . $d->PercentProcessorTime .  "% " . $d->ThreadCount . "<br>" ;
        }
    } else {
        echo "Uh oh, looks like we couldn't connect.";
    }
});

Route::get('/inventory', function() {
    return view('2test');
});
Route::get('/kocak', function() {
    // $a = DB::connection('PMPG')->table('materialItem')->take(100)->get();
    $inquepg = DB::connection('PMPG')->select("select count(StatusCode) as 'IN' from ConnectorInQueue
where MessageDateTime between CONVERT(date, GETDATE() -1) and GETDATE()
and ProcessedDateTime = '1899-12-30 00:00:00.000'
and CommsChannel = 'EFLOW'
--and Sender <> 'Plant:10 Auto-Count:LRF-11'");

    $outquepg = DB::connection('PMPG')->select("select count(StatusCode) as 'OUT' from ConnectorOutQueue
where MessageDateTime between CONVERT(date, GETDATE() -1) and GETDATE()
and CommsChannel = 'EFLOW'
and ProcessedDateTime = '1899-12-30 00:00:00.000'");

    $data = [
        'PG' => [
            'inque' => $inquepg[0]->IN,
            'outque' => $outquepg[0]->OUT,
        ]
    ];
    return response()->json($data);
});


//Hello ini update data
// Route::get('/license', [LicenseController::class, 'index']);


// Route::get('/testmail', [TestMailController::class, 'index']);

Route::get('/event', function() {
    $user = UserComputer::get()->toJson();
    ComputerUserCreated::dispatch($user);

    return view('main');
});



// Route::get('/computer', [ComputerController::class, 'show']);
Route::get('/teradocu', function() {

    $a = DB::connection('pgsql')->table('teradocu.sales_order')->take(10)->get();
//     $data = DB::connection('pgsql')->SELECT("select procedureId,procedureTypeName,salesName,customerName,uom_quantity,type,print_date,itemfg,referenceId,procedureNo,timestamp,status from (
// select distinct on (a.id) a.id as procedureId,
//                 b.name as procedureTypeName,
//                 c.sales_name as salesName,
//                 c.customer_name as customerName,
//                 c.type as type,
//                 c.print_date as print_date,
//                 c.uom_quantity as uom_quantity,
//                 c.item_fg as itemfg,
//                 a.reference_id as referenceId,
//                 (case when c.sales_order_no is not null then c.sales_order_no else null
//                 end) as procedureNo,
//                 e.timestamp,
//                 (case when c.status is not null then c.status else null
//                 end) as status
// from teradocu.procedure a
// inner join teradocu.procedure_log e on a.id=e.procedure_id
// inner join teradocu.procedure_type b on a.procedure_type_id=b.id
// left join teradocu.sales_order c on a.reference_id=c.id
// left join teradocu.inbox f on f.procedure_id=a.id
// where b.name in ('SALES ORDER')
// and f.id is null
// and c.status='CLOSE'
// order by a.id, e.timestamp
// ) as table1
// order by timestamp");

    $data = DB::connection('pgsql')->select("select procedureId,procedureTypeName,haveReadyDate, salesName,customerName,uom_quantity,type,print_date,itemfg,referenceId,procedureNo,timestamp,status,documentId,attacmentId,documentName, attachmentName from (
select distinct on (a.id) a.id as procedureId,
                b.name as procedureTypeName,
				c.have_ready_date as haveReadyDate,
                c.sales_name as salesName,
                c.customer_name as customerName,
                c.type as type,
                c.print_date as print_date,
                c.uom_quantity as uom_quantity,
                c.item_fg as itemfg,
                a.reference_id as referenceId,
				g.id as documentId,
				g.filename as documentName,
				h.id as attacmentId,
				h.filename as attachmentName,
                (case when c.sales_order_no is not null then c.sales_order_no else null
                end) as procedureNo,
                e.timestamp,
                (case when c.status is not null then c.status else null
                end) as status
from teradocu.procedure a
inner join teradocu.procedure_log e on a.id=e.procedure_id
inner join teradocu.procedure_type b on a.procedure_type_id=b.id
left join teradocu.sales_order c on a.reference_id=c.id
left join teradocu.inbox f on f.procedure_id=a.id
left JOIN teradocu.sales_order_document g on a.reference_id=g.sales_order_id
left JOIN teradocu.sales_order_attachment h on a.reference_id=h.sales_order_id
where b.name in ('SALES ORDER')
and f.id is null
and c.status='CLOSE'
order by a.id, e.timestamp
) as table1
order by timestamp DESC");
    // $data = collect($data)->each(function($item) {
    //     // dd(strtotime($item->timestamp));
    //     $item->date = Carbon::parse($item->timestamp)->format('d-m-Y');
    // });
    // // dd(now()->isoFormat('d-M-Y'));
    // $data = collect($data)->groupBy('date');
    // // dd($data);
    $keys = collect($a[0])->keys();
    return view('tera1', ['data' => $data]);
});
// Route::get('/kocakbgt', function() {
//     return csrf_token();
// });

Route::get('/createDB', function() {
    return view('createDB');
});

Route::post('/createDB', function(Request $request) {
    // dd($request->all()['db_name']);
    $db_name = $request->db_name;
    $host = "localhost";
    $user = "root";
    $password = "";
    try {
        $con = new PDO("mysql:host=$host", $user, $password);
    } catch (PDOException $pe) {
        die("Could not connect to the database :" . $pe->getMessage());
    }

    $dbname = "`".str_replace("`","``",$db_name)."`";
    $con->query("CREATE DATABASE IF NOT EXISTS $dbname");
    $con->query("use $dbname");
})->name('createDB.store');

Route::get('/create_table/{db_name}', function($db_name) {
    $db_name = $db_name;
    $host = "localhost";
    $user = "root";
    $password = "";
    try {
        $con = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);
    } catch (PDOException $pe) {
        die("Could not connect to the database :" . $pe->getMessage());
    }

    $sql = "SHOW TABLES";

    $statement = $con->prepare($sql);

    //Execute the statement.
    $statement->execute();

    //Fetch the rows from our statement.
    $tables = $statement->fetchAll(PDO::FETCH_NUM);


    return view('createTable', ['db_name' => $db_name, 'tables' => $tables]);
})->name('create_table.create');

Route::post('/create_table', function(Request $request) {
    $db_name = $request->db_name;
    $tbl_name = $request->tbl_name;
    $field = $request->field;
    $host = "localhost";
    $user = "root";
    $password = "";
    try {
        $con = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);
    } catch (PDOException $pe) {
        die("Could not connect to the database :" . $pe->getMessage());
    }

    $con->query("CREATE TABLE IF NOT EXISTS $tbl_name(
        $field VARCHAR(255) NOT NULL
    )");

    return redirect()->route('create_table.create', $db_name);
        //

})->name('createTable.store');

Route::get('/computer', [StockOpnameController::class, 'getData']);

Route::any('/{any}', function() {
    return view('welcome');
})->where('any', '.*');
