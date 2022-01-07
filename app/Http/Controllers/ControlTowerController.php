<?php

namespace App\Http\Controllers;

use App\Models\ControlTower;
use Carbon\Carbon;
use http\Env\Response;
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
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-info" data-id="'.$row['id'].'" id="dockTrackBtn">P</button>
                            <button class="btn btn-sm btn-outline-primary" data-id="'.$row['id'].'" id="startTrackBtn">S</button>
                        </div>';
            })
            ->addColumn('checkbox', function ($row){
                return'<input type="checkbox" name="track-checkbox" data-id="'.$row['id'].'"><label></label>';
            })
            ->rawColumns(['actions','checkbox'])
            ->make(true);
    }
//Create new track
    public function createTrack(Request $request)
    {
        $track_id = $request->cid_create_track;
        $validator = \Validator::make($request->all(), [
            'vehicle_id'=>'required|max:20',
            'track_id'=>'required|unique:control_towers|max:10',
            'track_type'=>'required|max:5',
            'freight'=>'required|numeric|between:1,66',
            'eta'=>'required|date',
        ]);
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
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
            'vehicle_id'=>'required|max:20',
            'track_id'=>'required|unique:control_towers|max:10',
            'track_type'=>'required|max:5',
            'freight'=>'required|numeric|between:1,66',
            'eta'=>'required|date',
        ]);
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $track = ControlTower::find($track_id);
            $track->vehicle_id = $request->vehicle_id;
            $track->track_id = $request->track_id;
            $track->track_type = $request->track_type;
            $track->freight = $request->freight;
            $track->eta = $request->eta;
            $track->docking_plan = Carbon::parse($track->eta)->subMinutes($track->freight * 1.5 + 15);
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
//Docking track get data
    public function getDockDataTrack(Request $request)
    {
        $track_id = $request->track_id;
        $trackDetails = ControlTower::find($track_id);
        return response()->json(['details'=>$trackDetails]);
    }
//Docking track update data
    public function dockTrack(Request $request)
    {
        $track_id = $request->cid_dock_track;
        $validator = \Validator::make($request->all(),[
            'ramp'=>'required|max:5',
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $track = ControlTower::find($track_id);
            $track->ramp = $request->ramp;
            $track->docked_at = Carbon::now();
            $query = $track->save();
            if ($query){
                return response()->json(['code'=>1,'msg'=>'Samochód poodstawiony pod rampę']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Wystąpił nieoczekiwany błąd']);
            }
        }
    }
//Load start get data
    public function getLoadStartData(Request $request)
    {
        $track_id = $request->track_id;
        $trackDetails = ControlTower::find($track_id);
        return response()->json(['details'=>$trackDetails]);
    }
//Load start update data
    public function loadStart(Request $request)
    {
        $track_id = $request->cid_l_start_track;
        $validator = \Validator::make($request->all(),[
           'worker_id'=>'required|max:5',
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $track = ControlTower::find($track_id);
            $track->worker_id = $request->worker_id;
            $track->task_start = Carbon::now();
            $track->task_end_exp = Carbon::parse($track->task_start)->addMinutes($track->freight * 1.5 +15);
            $track->doc_return_exp = Carbon::parse($track->eta)->subMinutes(15);
            $query = $track->save();
            if ($query){
                return response()->json(['code'=>1,'msg'=>'Operacja przeładunku rozpoczęta']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Wystąpił nieoczekiwany błąd']);
            }
        }
    }
}
