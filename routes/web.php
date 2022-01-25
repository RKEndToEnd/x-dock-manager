<?php

use App\Http\Controllers\DeparturesControlTowerController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ControlTowerController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/list',[UserController::class,'index'])->name('users.index');
Route::get('/getUsersList',[UserController::class,'getUsersList'])->name('get.users.list');
Route::post('/addUser',[UserController::class,'addUser'])->name('add.user');
Route::post('/getUserDetails',[UserController::class,'getUserDetails'])->name('get.user.details');
Route::post('/updateUserDetails',[UserController::class,'updateUserDetails'])->name('update.user.details');
Route::post('/deleteUser',[UserController::class,'deleteUser'])->name('delete.user');

Route::get('/depots/list',[DepotController::class,'index'])->name('depots.index');
Route::get('getDepotsList',[DepotController::class,'getDepotsList'])->name('get.depots.list');
Route::post('createDepot',[DepotController::class,'createDepot'])->name('create.depot');
Route::post('/getDepotDetails',[DepotController::class,'getDepotDetails'])->name('get.depot.details');
Route::post('/updateDepotDetails',[DepotController::class,'updateDepotDetails'])->name('update.depot.details');
Route::post('/deleteDepot',[DepotController::class,'deleteDepot'])->name('delete.depot');

Route::get('/tower',[ControlTowerController::class,'index'])->name('tower.index');
Route::get('/getTrackList',[ControlTowerController::class,'getTrackList'])->name('get.track.list');
Route::post('/createTrack',[ControlTowerController::class,'createTrack'])->name('create.track');
Route::post('/getTrackDetails',[ControlTowerController::class,'getTrackDetails'])->name('get.track.details');
Route::post('/updateTrackDetails',[ControlTowerController::class,'updateTrackDetails'])->name('update.track.details');
Route::post('/deleteTrack',[ControlTowerController::class,'deleteTrack'])->name('delete.track');
Route::post('/bulkDeleteTrack',[ControlTowerController::class,'bulkDeleteTrack'])->name('bulk.delete.track');
Route::post('/getSaEditData',[ControlTowerController::class,'getSaEditData'])->name('get.sa.edit.data');
Route::post('/saUpdateData',[ControlTowerController::class,'saUpdateData'])->name('sa.update.data');

Route::post('/getDockDataTrack',[ControlTowerController::class,'getDockDataTrack'])->name('get.dock.data.track');
Route::post('/dockTrack',[ControlTowerController::class,'dockTrack'])->name('dock.track');
Route::post('/getLoadStartData',[ControlTowerController::class,'getLoadStartData'])->name('get.load.start.data');
Route::post('/loadStart',[ControlTowerController::class,'loadStart'])->name('load.start');
Route::post('/getLoadStopData',[ControlTowerController::class,'getLoadStopData'])->name('get.load.stop.data');
Route::post('/loadStop',[ControlTowerController::class,'loadStop'])->name('load.stop');
Route::post('/getDocReadyData',[ControlTowerController::class,'getDocReadyData'])->name('get.doc.ready.data');
Route::post('/docReady',[ControlTowerController::class,'docReady'])->name('doc.ready');
Route::post('/getDepartureData',[ControlTowerController::class,'getDepartureData'])->name('get.departure.data');
Route::post('/trackDeparted',[ControlTowerController::class,'trackDeparted'])->name('track.departed');

Route::get('/departed_tracks',[DeparturesControlTowerController::class,'index'])->name('departed_tracks.index');
Route::get('getDepartedTrackList',[DeparturesControlTowerController::class,'getDepartedTrackList'])->name('get.departed.track.list');




// ONLY FOR TESTING
/*Route::get('getMap',[DepotController::class,'getMap'])->name('get.map');*/

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
