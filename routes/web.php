<?php

use App\Http\Controllers\DeparturesControlTowerController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RampController;
use App\Http\Controllers\RampStatusController;
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

Route::middleware(['auth'])->group(function (){
    Route::get('/users/list',[UserController::class,'index'])->name('users.index')->middleware('role:super-admin|admin|moderator');
    Route::get('/getUsersList',[UserController::class,'getUsersList'])->name('get.users.list')->middleware('role:super-admin|admin|moderator');
    Route::post('/addUser',[UserController::class,'addUser'])->name('add.user')->middleware('role:super-admin|admin');
    Route::post('/getUserDetails',[UserController::class,'getUserDetails'])->name('get.user.details')->middleware('role:super-admin|admin');
    Route::post('/updateUserDetails',[UserController::class,'updateUserDetails'])->name('update.user.details')->middleware('role:super-admin|admin');
    Route::post('/deleteUser',[UserController::class,'deleteUser'])->name('delete.user')->middleware('role:super-admin');

    Route::group(['middleware'=>['role:super-admin']],function (){
        Route::get('users/roles',[UserController::class,'roles'])->name('roles');
        Route::get('getRoles',[UserController::class,'getRoles'])->name('get.roles');
        Route::post('createRole',[UserController::class,'createRole'])->name('create.role');
        Route::get('users/roles/assigned',[UserController::class,'assignedRoles'])->name('assigned.roles');
        Route::get('getAsRoles',[UserController::class,'getAsRoles'])->name('get.as.roles');
        Route::post('assignRole',[UserController::class,'assignRole'])->name('assign.role');
    });

    Route::get('/depots/list',[DepotController::class,'index'])->name('depots.index')->middleware('role:super-admin|admin|moderator');
    Route::get('getDepotsList',[DepotController::class,'getDepotsList'])->name('get.depots.list')->middleware('role:super-admin|admin|moderator');
    Route::post('createDepot',[DepotController::class,'createDepot'])->name('create.depot')->middleware('role:super-admin|admin');
    Route::post('/getDepotDetails',[DepotController::class,'getDepotDetails'])->name('get.depot.details')->middleware('role:super-admin|admin');
    Route::post('/updateDepotDetails',[DepotController::class,'updateDepotDetails'])->name('update.depot.details')->middleware('role:super-admin|admin');
    Route::post('/deleteDepot',[DepotController::class,'deleteDepot'])->name('delete.depot')->middleware('role:super-admin');

    Route::get('/ramps/list',[RampController::class,'index'])->name('ramps.index')->middleware('role:super-admin|admin|moderator');
    Route::get('getRampsList',[RampController::class,'getRampsList'])->name('get.ramps.list')->middleware('role:super-admin|admin|moderator');
    Route::post('createRamp',[RampController::class,'createRamp'])->name('create.ramp')->middleware('role:super-admin|admin');
    Route::post('/deleteRamp',[RampController::class,'deleteRamp'])->name('delete.ramp')->middleware('role:super-admin');

    Route::get('/ramps/statuses',[RampStatusController::class,'statuses'])->name('statuses.index')->middleware('role:super-admin|admin|moderator');
    Route::get('getStatusesList',[RampStatusController::class,'getStatusesList'])->name('get.statuses.list')->middleware('role:super-admin|admin|moderator');
    Route::post('createStatus',[RampStatusController::class,'createStatus'])->name('create.status')->middleware('role:super-admin|admin');
    Route::post('/deleteStatus',[RampStatusController::class,'deleteStatus'])->name('delete.status')->middleware('role:super-admin');
    Route::post('getStatusDetails',[RampStatusController::class,'getStatusDetails'])->name('get.status.details')->middleware('role:super-admin|admin');
    Route::post('updateStatusDetails',[RampStatusController::class,'updateStatusDetails'])->name('update.status.details')->middleware('role:super-admin|admin');

    Route::get('/tower',[ControlTowerController::class,'index'])->name('tower.index')->middleware('role:super-admin|admin|moderator|user|observer');
    Route::get('/getTrackList',[ControlTowerController::class,'getTrackList'])->name('get.track.list')->middleware('role:super-admin|admin|moderator|user|observer');
    Route::post('/createTrack',[ControlTowerController::class,'createTrack'])->name('create.track')->middleware('role:super-admin|admin|moderator');
    Route::post('/getTrackDetails',[ControlTowerController::class,'getTrackDetails'])->name('get.track.details')->middleware('role:super-admin|admin|moderator');
    Route::post('/updateTrackDetails',[ControlTowerController::class,'updateTrackDetails'])->name('update.track.details')->middleware('role:super-admin|admin|moderator');
    Route::post('/deleteTrack',[ControlTowerController::class,'deleteTrack'])->name('delete.track')->middleware('role:super-admin|admin');
    Route::post('/bulkDeleteTrack',[ControlTowerController::class,'bulkDeleteTrack'])->name('bulk.delete.track')->middleware('role:super-admin|admin');
    Route::post('/getSaEditData',[ControlTowerController::class,'getSaEditData'])->name('get.sa.edit.data')->middleware('role:super-admin');
    Route::post('/saUpdateData',[ControlTowerController::class,'saUpdateData'])->name('sa.update.data')->middleware('role:super-admin');
    Route::post('/import',[ControlTowerController::class,'import'])->name('track.import')->middleware('role:super-admin|admin|moderator');
    Route::post('/importUpdate',[ControlTowerController::class,'importUpdate'])->name('import.update')->middleware('role:super-admin|admin|moderator');

    Route::post('/getDockDataTrack',[ControlTowerController::class,'getDockDataTrack'])->name('get.dock.data.track')->middleware('role:super-admin|admin|moderator|user');
    Route::post('/dockTrack',[ControlTowerController::class,'dockTrack'])->name('dock.track')->middleware('role:super-admin|admin|moderator|user');
    Route::post('/getLoadStartData',[ControlTowerController::class,'getLoadStartData'])->name('get.load.start.data')->middleware('role:super-admin|admin|moderator|user');
    Route::post('/loadStart',[ControlTowerController::class,'loadStart'])->name('load.start')->middleware('role:super-admin|admin|moderator|user');
    Route::post('/getLoadStopData',[ControlTowerController::class,'getLoadStopData'])->name('get.load.stop.data')->middleware('role:super-admin|admin|moderator|user');
    Route::post('/loadStop',[ControlTowerController::class,'loadStop'])->name('load.stop')->middleware('role:super-admin|admin|moderator|user');
    Route::post('/getDocReadyData',[ControlTowerController::class,'getDocReadyData'])->name('get.doc.ready.data')->middleware('role:super-admin|admin|moderator|user');
    Route::post('/docReady',[ControlTowerController::class,'docReady'])->name('doc.ready')->middleware('role:super-admin|admin|moderator|user');
    Route::post('/getDepartureData',[ControlTowerController::class,'getDepartureData'])->name('get.departure.data')->middleware('role:super-admin|admin|moderator|user');
    Route::post('/trackDeparted',[ControlTowerController::class,'trackDeparted'])->name('track.departed')->middleware('role:super-admin|admin|moderator|user');

    Route::get('/departed_tracks',[DeparturesControlTowerController::class,'index'])->name('departed_tracks.index')->middleware('role:super-admin|admin|moderator|user|observer');
    Route::get('getDepartedTrackList',[DeparturesControlTowerController::class,'getDepartedTrackList'])->name('get.departed.track.list')->middleware('role:super-admin|admin|moderator|user|observer');
});

// ONLY FOR TESTING
/*Route::get('getMap',[DepotController::class,'getMap'])->name('get.map');*/

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
