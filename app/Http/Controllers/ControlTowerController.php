<?php

namespace App\Http\Controllers;

use App\Models\ControlTower;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ControlTowerController extends Controller
{
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
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <button class="btn btn-sm btn-warning" data-id="' . $row['id'] . '" id="editTrackBtn">E</button>
                            <button class="btn btn-sm btn-danger" data-id="' . $row['id'] . '" id="deleteTrackBtn">X</button>
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
        $track->docking_plan = Carbon::parse($track->eta)->subMinutes($track->freight * 1.5 + 15);
        $query = $track->save();
        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Trasa została dodana do bazy danych']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
        }
    }
    //Get track details
    public function getTrackDetails(Request $request)
    {
        $track_id = $request->track_id;
        $trackDetails = ControlTower::find($track_id);
        return response()->json(['details' => $trackDetails]);
    }
    //Update track details
    public function updateTrackDetails(Request $request)
    {
        $track_id = $request->cid_track;
        $validator = \Validator::make($request->all(), [

        ]);
        if (!$validator->passes())
        {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray]);
        } else {
            $track = ControlTower::find($track_id);
            $track->vehicle_id = $request->vehicle_id;
            $track->track_id = $request->track_id;
            $track->track_type = $request->track_type;
            $track->freight = $request->freight;
            $track->eta = $request->eta;
            $query = $track->save();
            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Dane trasy zostały zaktualizowane']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
            }
        }
    }
    //Delete track
    public function deleteTrack(Request $request)
    {
        $track_id = $request->track_id;
        $query = ControlTower::find($track_id)->delete();
        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Trasa została usunieta z bazy danych']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Wystapił nieoczekiwany błąd']);
        }
    }
}
