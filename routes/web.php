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
    Route::controller(UserController::class)->group(function () {
        Route::get('/users/list', 'index')->name('users.index')->middleware('role:super-admin|admin|moderator');
        Route::get('/getUsersList', 'getUsersList')->name('get.users.list')->middleware('role:super-admin|admin|moderator');
        Route::post('/addUser', 'addUser')->name('add.user')->middleware('role:super-admin|admin');
        Route::post('/getUserDetails', 'getUserDetails')->name('get.user.details')->middleware('role:super-admin|admin');
        Route::post('/updateUserDetails', 'updateUserDetails')->name('update.user.details')->middleware('role:super-admin|admin');
        Route::post('/deleteUser', 'deleteUser')->name('delete.user')->middleware('role:super-admin');
    });
    Route::group(['middleware'=>['role:super-admin']],function (){
        Route::controller(UserController::class)->group(function (){
            Route::get('users/roles','roles')->name('roles');
            Route::get('getRoles','getRoles')->name('get.roles');
            Route::post('createRole','createRole')->name('create.role');
            Route::get('users/roles/assigned','assignedRoles')->name('assigned.roles');
            Route::get('getAsRoles','getAsRoles')->name('get.as.roles');
            Route::post('assignRole','assignRole')->name('assign.role');
        });
    });
    Route::controller(DepotController::class)->group(function (){
        Route::get('/depots/list','index')->name('depots.index')->middleware('role:super-admin|admin|moderator');
        Route::get('getDepotsList','getDepotsList')->name('get.depots.list')->middleware('role:super-admin|admin|moderator');
        Route::post('createDepot','createDepot')->name('create.depot')->middleware('role:super-admin|admin');
        Route::post('/getDepotDetails','getDepotDetails')->name('get.depot.details')->middleware('role:super-admin|admin');
        Route::post('/updateDepotDetails','updateDepotDetails')->name('update.depot.details')->middleware('role:super-admin|admin');
        Route::post('/deleteDepot','deleteDepot')->name('delete.depot')->middleware('role:super-admin');
    });
    Route::controller(RampController::class)->group(function (){
        Route::get('/ramps/list','index')->name('ramps.index')->middleware('role:super-admin|admin|moderator');
        Route::get('getRampsList','getRampsList')->name('get.ramps.list')->middleware('role:super-admin|admin|moderator');
        Route::post('createRamp','createRamp')->name('create.ramp')->middleware('role:super-admin|admin');
        Route::post('/deleteRamp','deleteRamp')->name('delete.ramp')->middleware('role:super-admin');
        Route::post('getRampStatus','getRampStatus')->name('get.ramp.status')->middleware('role:super-admin|admin');
        Route::post('updateRampStatus','updateRampStatus')->name('update.ramp.status')->middleware('role:super-admin|admin');
    });
    Route::controller(RampStatusController::class)->group(function () {
        Route::get('/ramps/statuses',  'statuses')->name('statuses.index')->middleware('role:super-admin|admin|moderator');
        Route::get('getStatusesList', 'getStatusesList')->name('get.statuses.list')->middleware('role:super-admin|admin|moderator');
        Route::post('createStatus',  'createStatus')->name('create.status')->middleware('role:super-admin|admin');
        Route::post('/deleteStatus', 'deleteStatus')->name('delete.status')->middleware('role:super-admin');
        Route::post('getStatusDetails', 'getStatusDetails')->name('get.status.details')->middleware('role:super-admin|admin');
        Route::post('updateStatusDetails',  'updateStatusDetails')->name('update.status.details')->middleware('role:super-admin|admin');
    });
    Route::controller(ControlTowerController::class)->group(function (){
        Route::get('/tower','index')->name('tower.index')->middleware('role:super-admin|admin|moderator|user|observer');
        Route::get('/getTrackList','getTrackList')->name('get.track.list')->middleware('role:super-admin|admin|moderator|user|observer');
        Route::post('/createTrack','createTrack')->name('create.track')->middleware('role:super-admin|admin|moderator');
        Route::post('/getTrackDetails','getTrackDetails')->name('get.track.details')->middleware('role:super-admin|admin|moderator');
        Route::post('/updateTrackDetails','updateTrackDetails')->name('update.track.details')->middleware('role:super-admin|admin|moderator');
        Route::post('/deleteTrack','deleteTrack')->name('delete.track')->middleware('role:super-admin|admin');
        Route::post('/bulkDeleteTrack','bulkDeleteTrack')->name('bulk.delete.track')->middleware('role:super-admin|admin');
        Route::post('/getSaEditData','getSaEditData')->name('get.sa.edit.data')->middleware('role:super-admin');
        Route::post('/saUpdateData','saUpdateData')->name('sa.update.data')->middleware('role:super-admin');
        Route::post('/import','import')->name('track.import')->middleware('role:super-admin|admin|moderator');
        Route::post('/importUpdate','importUpdate')->name('import.update')->middleware('role:super-admin|admin|moderator');

        Route::post('/getDockDataTrack','getDockDataTrack')->name('get.dock.data.track')->middleware('role:super-admin|admin|moderator|user');
        Route::post('/dockTrack','dockTrack')->name('dock.track')->middleware('role:super-admin|admin|moderator|user');
        Route::post('/getLoadStartData','getLoadStartData')->name('get.load.start.data')->middleware('role:super-admin|admin|moderator|user');
        Route::post('/loadStart','loadStart')->name('load.start')->middleware('role:super-admin|admin|moderator|user');
        Route::post('/getLoadStopData','getLoadStopData')->name('get.load.stop.data')->middleware('role:super-admin|admin|moderator|user');
        Route::post('/loadStop','loadStop')->name('load.stop')->middleware('role:super-admin|admin|moderator|user');
        Route::post('/getDocReadyData','getDocReadyData')->name('get.doc.ready.data')->middleware('role:super-admin|admin|moderator|user');
        Route::post('/docReady','docReady')->name('doc.ready')->middleware('role:super-admin|admin|moderator|user');
        Route::post('/getDepartureData','getDepartureData')->name('get.departure.data')->middleware('role:super-admin|admin|moderator|user');
        Route::post('/trackDeparted','trackDeparted')->name('track.departed')->middleware('role:super-admin|admin|moderator|user');
    });
    Route::controller(DeparturesControlTowerController::class)->group(function (){
        Route::get('/departed_tracks','index')->name('departed_tracks.index')->middleware('role:super-admin|admin|moderator|user|observer');
        Route::get('getDepartedTrackList','getDepartedTrackList')->name('get.departed.track.list')->middleware('role:super-admin|admin|moderator|user|observer');
        });
});

// ONLY FOR TESTING
/*Route::get('getMap',[DepotController::class,'getMap'])->name('get.map');*/

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
