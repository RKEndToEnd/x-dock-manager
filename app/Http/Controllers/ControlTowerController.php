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
                            <button class="btn btn-sm btn-outline-danger" data-id="' . $row['id'] . '" id="saEditTrackBtn">SA <i class="fas fa-user-cog"></i></button>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-warning" data-id="' . $row['id'] . '" id="editTrackBtn"><i class="far fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-id="' . $row['id'] . '" id="deleteTrackBtn"><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-info" data-id="' . $row['id'] . '" id="dockTrackBtn"><i class="fas fa-anchor"></i></button>
                            <button class="btn btn-sm btn-outline-primary" data-id="' . $row['id'] . '" id="startTrackBtn"><i class="fas fa-play"></i></button>
                            <button class="btn btn-sm btn-outline-success" data-id="' . $row['id'] . '" id="stopTrackBtn"><i class="fas fa-stop"></i></button>
                            <button class="btn btn-sm btn-outline-secondary" data-id="' . $row['id'] . '" id=docReadyBtn><i class="fas fa-file-alt"></i></button>
                        </div>';
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" name="track-checkbox" data-id="' . $row['id'] . '"><label></label>';
            })
            /*->setRowId('id')*/
            ->setRowClass(function ($row) {
                if (Carbon::now() > $row->docking_plan)
                    return 2 == 0 ? '' : 'alert-danger';
                else if (Carbon::now() > Carbon::parse($row->docking_plan)->subMinutes(30) && $row->ramp == null)
                    return 2 == 0 ? '' : 'alert-warning';
            })
            ->rawColumns(['actions', 'checkbox'])
            ->make(true);
    }

//Create new track
    public function createTrack(Request $request)
    {
        $track_id = $request->cid_create_track;
        $validator = \Validator::make($request->all(), [
            'vehicle_id' => 'required|max:20',
            'track_id' => 'required|unique:control_towers|max:10',
            'track_type' => 'required|max:5',
            'freight' => 'required|numeric|between:1,66',
            'eta' => 'required|date',
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
            'vehicle_id' => 'required|max:20',
            'track_type' => 'required|max:5',
            'freight' => 'required|numeric|between:1,66',
            'eta' => 'required|date',
        ]);
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $track = ControlTower::find($track_id);
            $track->vehicle_id = $request->vehicle_id;
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

//Deleting selected tracks
    public function bulkDeleteTrack(Request $request)
    {
        $track_ids = $request->tracks_ids;
        ControlTower::whereIn('id', $track_ids)->delete();
        return response()->json(['code' => 1, 'msg' => 'Zaznaczone trasy zostały usuniete z bazy danych']);
    }

//Docking track get data
    public function getDockDataTrack(Request $request)
    {
        $track_id = $request->track_id;
        $trackDetails = ControlTower::find($track_id);
        return response()->json(['details' => $trackDetails]);
    }

//Docking track update data
    public function dockTrack(Request $request)
    {
        $track_id = $request->cid_dock_track;
        $validator = \Validator::make($request->all(), [
            'ramp' => 'required|max:5',
        ]);
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $track = ControlTower::find($track_id);
            if (!ControlTower::where('ramp','=',$request->input($track->ramp))->exists()){
                $track->ramp = $request->ramp;
                $track->docked_at = Carbon::now();
                $query = $track->save();
                if ($query) {
                    return response()->json(['code' => 1, 'msg' => 'Samochód podstawiony pod rampę']);
                } else {
                    return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
                }
            }else{
                return response()->json(['code' => 1, 'msg' => 'Trasa jest już podstawiona pod rampę. Zmiany można dokonać w trybie edycji Super Admin.']);
            }
        }
    }

//Load start track get data
    public function getLoadStartData(Request $request)
    {
        $track_id = $request->track_id;
        $trackDetails = ControlTower::find($track_id);
        return response()->json(['details' => $trackDetails]);
    }

//Load start track update data
    public function loadStart(Request $request)
    {
        $track_id = $request->cid_l_start_track;
        $validator = \Validator::make($request->all(), [
            'worker_id' => 'required|max:5',
        ]);
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $track = ControlTower::find($track_id);
            if (ControlTower::where('ramp','=',$request->input($track->ramp))->exists()){
                    if (!ControlTower::where('worker_id','=',$request->input($track->worker_id))->exists()) {
                        $track->worker_id = $request->worker_id;
                        $track->task_start = Carbon::now();
                        $track->task_end_exp = Carbon::parse($track->task_start)->addMinutes($track->freight * 1.5 + 15);
                        $track->doc_return_exp = Carbon::parse($track->eta)->subMinutes(15);
                        $query = $track->save();
                        if ($query) {
                            return response()->json(['code' => 1, 'msg' => 'Operacja przeładunku rozpoczęta']);
                        } else {
                            return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
                        }
                    }else{
                        return response()->json(['code' => 1, 'msg' => 'Uwaga! Operacja przeładunku została już rozpoczęta. Zmiany mozna dokonać w trybie edycji Super Admin']);
                    }
            }else{
                return response()->json(['code' => 1, 'msg' => 'Uwaga! Nie można ropocząć operacji załadunku. Trasa nie jest podstawiona pod rampę.']);
            }
        }
    }

//Load stop track get data
    public function getLoadStopData(Request $request)
    {
        $track_id = $request->track_id;
        $trackDetails = ControlTower::find($track_id);
        return response()->json(['details' => $trackDetails]);
    }

//Load stop track update data
    public function loadStop(Request $request)
    {
        $track_id = $request->cid_l_stop_track;
        $validator = \Validator::make($request->all(), [
        ]);
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $track = ControlTower::find($track_id);
            if (ControlTower::where('task_start','=',$request->input($track->task_start))->exists()) {
                if (!ControlTower::where('task_end','=',$request->input($track->task_end))->exists()) {
                    $track->task_end = Carbon::now();
                    $query = $track->save();
                    if ($query) {
                        return response()->json(['code' => 1, 'msg' => 'Operacja przeładunku zakończona']);
                    } else {
                        return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
                    }
                }else{
                    return response()->json(['code' => 1, 'msg' => 'Uwaga! Operacja przeładunku została już zakończona. Edycji można dokonać w trybie Super Admin']);
                }
            }else{
                return response()->json(['code' => 1, 'msg' => 'Uwaga! Nie można zakończyć operacji załadunku, ponieważ nie została ona ropoczęta.']);
            }
        }
    }

//Documents ready get data
    public function getDocReadyData(Request $request)
    {
        $track_id = $request->track_id;
        $trackDetails = ControlTower::find($track_id);
        return response()->json(['details' => $trackDetails]);
    }

//Documents ready update data
    public function docReady(Request $request)
    {
        $track_id = $request->cid_doc_ready;
        $track = ControlTower::find($track_id);

        if ($track->eta < Carbon::now()){
            $validator = \Validator::make($request->all(), [
                'comment'=>'required|string|max:255',
            ]);
            if (!$validator->passes()) {
                return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
            } else {
                $track = ControlTower::find($track_id);
                if (ControlTower::where('task_end','=',$request->input($track->task_end))->exists()) {
                    if (!ControlTower::where('doc_ready','=',$request->input($track->doc_ready))->exists()) {
                        $track->doc_ready = Carbon::now();
                        $track->comment = $request->comment;
                        $query = $track->save();
                        if ($query) {
                            return response()->json(['code' => 1, 'msg' => 'Dokumenty gotowe do odbioru. Uwaga! Trasa została załadowana z opóźnieniem.']);
                        } else {
                            return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
                        }
                    }else{
                        return response()->json(['code' => 1, 'msg' => 'Uwaga! Dokumenty zostały już zarejestrowane. Edycji można dokonać w trybie Super Admin']);
                    }
                }else{
                    return response()->json(['code' => 1, 'msg' => 'Uwaga! Nie można przygotować dokumentów. Trasa nie została załadowana.']);
                }
            }
        } else {
            $track = ControlTower::find($track_id);
            if (ControlTower::where('task_end', '=', $request->input($track->task_end))->exists()) {
                if (!ControlTower::where('doc_ready','=',$request->input($track->doc_ready))->exists()) {
                    $track->doc_ready = Carbon::now();
                    $track->comment = $request->comment;
                    $query = $track->save();
                    if ($query) {
                        return response()->json(['code' => 1, 'msg' => 'Dokumenty gotowe do odbioru.']);
                    } else {
                        return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
                    }
                }else{
                    return response()->json(['code' => 1, 'msg' => 'Uwaga! Dokumenty zostały już zarejestrowane. Edycji można dokonać w trybie Super Admin']);
                }
            } else {
                return response()->json(['code' => 1, 'msg' => 'Uwaga! Nie można przygotować dokumentów. Trasa nie została załadowana.']);
            }
        }
    }

}
