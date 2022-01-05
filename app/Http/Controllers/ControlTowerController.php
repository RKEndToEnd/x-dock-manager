<?php

namespace App\Http\Controllers;

use App\Models\ControlTower;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ControlTowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('tower.index');
    }
    //Get all tracks
    public function getTrackList()
    {
        $tracks = ControlTower::all();
        return DataTables::of($tracks)
            ->addIndexColumn()
            ->addColumn('actions', function($row){
                return'<div class="btn-group">
                            <button class="btn btn-sm btn-warning" data-id="'.$row['id'].'" id="editTrackBtn">E</button>
                            <button class="btn btn-sm btn-danger" data-id="'.$row['id'].'" id="deleteTrackBtn">X</button>
            </div>';
        })
        ->rawColumns(['actions'])
        ->make(true);
    }
    //Create new track
    public function createTrack(Request $request)
    {
        $track = new ControlTower($request->all());
        $track->vehicle_id = $request->vehicle_id;
        $track->track_id = $request->track_id;
        $track->track_type = $request->track_type;
        $track->freight = $request->freight;
        $track->eta = $request->eta;
        $query = $track->save();
        if ($query){
            return response()->json(['code'=>1,'msg'=>'Trasa została dodana do bazy danych']);
        }else{
            return response()->json(['code'=>0,'msg'=>'Wystąpił nieoczekiwany błąd']);
        }
    }
    //Get track details
    public function getTrackDetails(Request $request)
    {
        $track_id = $request->track_id;
        $trackDetails = ControlTower::find($track_id);
        return response()->json(['details'=>$trackDetails]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ControlTower  $controlTower
     * @return Response
     */
    public function show(ControlTower $controlTower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ControlTower  $controlTower
     * @return Response
     */
    public function edit(ControlTower $controlTower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ControlTower  $controlTower
     * @return Response
     */
    public function update(Request $request, ControlTower $controlTower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ControlTower  $controlTower
     * @return Response
     */
    public function destroy(ControlTower $controlTower)
    {
        //
    }
}
