<?php

use App\Events\ComputerUserCreated;
use App\Http\Controllers\ComputerController;
use App\Models\UserComputer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

// Route::get('', function () {
//     return view('welcome');
// });
// Route::get('/kocak', function() {
//     return "Hello Harun Al Rasyid";
// });


Route::get('/event', function() {
    $user = UserComputer::get()->toJson();
    ComputerUserCreated::dispatch($user);

    return view('main');
});

// Route::get('/computer', [ComputerController::class, 'show']);

Route::get('/kocak', function() {
    return csrf_token();
});

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

Route::any('/{any}', function() {
    return view('welcome');
})->where('any', '.*');






