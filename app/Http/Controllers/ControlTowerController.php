<?php

namespace App\Http\Controllers;

use App\Imports\TrackImport;
use App\Models\ControlTower;
use App\Models\Ramp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class ControlTowerController extends Controller
{
    public function index(): View
    {
        return view("tower.index", ['users' => User::all()], ['ramps' => Ramp::all()->where('status', '=', '1')]);
    }

    public function getTrackList(Request $request)
    {
        if ($request->ajax()) {
            $tracks = ControlTower::with('ids', 'trace');
            return DataTables::of($tracks)
                ->addIndexColumn()
                ->addColumn('ids', function (ControlTower $tower) {
                    return $tower->ids->worker_id;
                })
                ->addColumn('trace', function (ControlTower $rampTower) {
                    return $rampTower->trace->name;
                })
                ->addColumn('actions', function ($row) {
                    if (Auth::user()->hasrole('super-admin')) {
                        return '
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-danger" data-id="' . $row['id'] . '" id="saEditTrackBtn" title="Edycja trasy Super-Admin" >SA <i class="fas fa-user-cog"></i></button>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-warning" data-id="' . $row['id'] . '" id="editTrackBtn" title="Edycja trasy"><i class="far fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-id="' . $row['id'] . '" id="deleteTrackBtn" title="Usuwanie trasy"><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-info" data-id="' . $row['id'] . '" id="dockTrackBtn" title="Podstawienie trasy pod rampę"><i class="fas fa-anchor"></i></button>
                            <button class="btn btn-sm btn-outline-primary" data-id="' . $row['id'] . '" id="startTrackBtn" title="Rozpoczęcie operacji przeładunku"><i class="fas fa-play"></i></button>
                            <button class="btn btn-sm btn-outline-success" data-id="' . $row['id'] . '" id="stopTrackBtn" title="Zakończenie operacji przeładunku"><i class="fas fa-stop"></i></button>
                            <button class="btn btn-sm btn-outline-secondary" data-id="' . $row['id'] . '" id=docReadyBtn title="Dokumenty gotowe do wydania"><i class="fas fa-file-alt"></i></button>
                            <button class="btn btn-sm btn-outline-info" data-id="' . $row['id'] . '" id="departureTrackBtn" title="Odjazd trasy"><i class="fas fa-plane-departure"></i></button>
                        </div>';
                    }
                    if (Auth::user()->hasrole('admin')) {
                        return '
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-warning" data-id="' . $row['id'] . '" id="editTrackBtn" title="Edycja trasy"><i class="far fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-id="' . $row['id'] . '" id="deleteTrackBtn" title="Usuwanie trasy"><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-info" data-id="' . $row['id'] . '" id="dockTrackBtn" title="Podstawienie trasy pod rampę"><i class="fas fa-anchor"></i></button>
                            <button class="btn btn-sm btn-outline-primary" data-id="' . $row['id'] . '" id="startTrackBtn" title="Rozpoczęcie operacji przeładunku"><i class="fas fa-play"></i></button>
                            <button class="btn btn-sm btn-outline-success" data-id="' . $row['id'] . '" id="stopTrackBtn" title="Zakończenie operacji przeładunku"><i class="fas fa-stop"></i></button>
                            <button class="btn btn-sm btn-outline-secondary" data-id="' . $row['id'] . '" id=docReadyBtn title="Dokumenty gotowe do wydania"><i class="fas fa-file-alt"></i></button>
                            <button class="btn btn-sm btn-outline-info" data-id="' . $row['id'] . '" id="departureTrackBtn" title="Odjazd trasy"><i class="fas fa-plane-departure"></i></button>
                        </div>';
                    }
                    if (Auth::user()->hasrole('moderator')) {
                        return '
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-warning" data-id="' . $row['id'] . '" id="editTrackBtn" title="Edycja trasy"><i class="far fa-edit"></i></button>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-info" data-id="' . $row['id'] . '" id="dockTrackBtn" title="Podstawienie trasy pod rampę"><i class="fas fa-anchor"></i></button>
                            <button class="btn btn-sm btn-outline-primary" data-id="' . $row['id'] . '" id="startTrackBtn" title="Rozpoczęcie operacji przeładunku"><i class="fas fa-play"></i></button>
                            <button class="btn btn-sm btn-outline-success" data-id="' . $row['id'] . '" id="stopTrackBtn" title="Zakończenie operacji przeładunku"><i class="fas fa-stop"></i></button>
                            <button class="btn btn-sm btn-outline-secondary" data-id="' . $row['id'] . '" id=docReadyBtn title="Dokumenty gotowe do wydania"><i class="fas fa-file-alt"></i></button>
                            <button class="btn btn-sm btn-outline-info" data-id="' . $row['id'] . '" id="departureTrackBtn" title="Odjazd trasy"><i class="fas fa-plane-departure"></i></button>
                        </div>';
                    }
                    if (Auth::user()->hasrole('user')) {
                        return '
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-info" data-id="' . $row['id'] . '" id="dockTrackBtn" title="Podstawienie trasy pod rampę"><i class="fas fa-anchor"></i></button>
                            <button class="btn btn-sm btn-outline-primary" data-id="' . $row['id'] . '" id="startTrackBtn" title="Rozpoczęcie operacji przeładunku"><i class="fas fa-play"></i></button>
                            <button class="btn btn-sm btn-outline-success" data-id="' . $row['id'] . '" id="stopTrackBtn" title="Zakończenie operacji przeładunku"><i class="fas fa-stop"></i></button>
                            <button class="btn btn-sm btn-outline-secondary" data-id="' . $row['id'] . '" id=docReadyBtn title="Dokumenty gotowe do wydania"><i class="fas fa-file-alt"></i></button>
                            <button class="btn btn-sm btn-outline-info" data-id="' . $row['id'] . '" id="departureTrackBtn" title="Odjazd trasy"><i class="fas fa-plane-departure"></i></button>
                        </div>';
                    }
                })
                ->addColumn('checkbox', function ($row) {
                    if (Auth::user()->hasrole('super-admin|admin')) {
                        return '<input type="checkbox" name="track-checkbox" data-id="' . $row['id'] . '"><label></label>';
                    }
                })
                ->addColumn('area', function ($row) {
                    $checked = ($row->area == 1) ? 'checked' : '';
                    return '
                        <div class="form-check form-switch">
                          <input class="form-check-input areaSwitch" type="checkbox" role="switch" id="areaSwitch" data-id="' . $row['id'] . '" ' . $checked . '>
                          <label class="form-check-label" for="areaSwitch"></label>
                        </div>';
                })
                ->setRowClass(function ($row) {
                    if (Carbon::now() > $row->docking_plan)
                        return 2 == 0 ? '' : 'alert-danger';
                    else if (Carbon::now() > Carbon::parse($row->docking_plan)->subMinutes(30) && $row->ramp == null)
                        return 2 == 0 ? '' : 'alert-warning';
                })
                ->rawColumns(['actions', 'checkbox', 'departure', 'area'])
                ->make(true);
        }
    }

//Create new track
    public function createTrack(Request $request)
    {
        $track_id = $request->cid_create_track;
        $validator = \Validator::make($request->all(), [
            'vehicle_id' => 'required|max:20',
            'track_id' => 'required|unique:control_towers|unique:departures_control_towers|max:10',
            'track_type' => 'required|max:2',
            'freight' => 'required|numeric|between:1,66',
            'eta' => 'required|date|after:yesterday',
        ], [
            'vehicle_id.required' => 'Nr rejestracyjny pojazdu jest wymagany.',
            'vehicle_id.max' => 'Nr rejestracyjny nie może być dłuszy niż 20 znaków.',
            'track_id.required' => 'Wprowadź numer trasy.',
            'track_id.unique' => 'Nie można użyć numeru trasy. Wprowadzony numer trasy istnieje w bazie danych aktualnych przeładunków lub tras przeładowanych.',
            'track_id.max' => 'Nr trasy nie może być dłuszy niż 10 znaków.',
            'track_type.required' => 'Typ trasy jest wymagany. Dostepne typy tras to: h -wahadło, d - dostawa, hp - wahadło przyjazd, p - odbiór.',
            'track_type.max' => 'Oznaczenie typu trasy nie może zawierać więcej niż 2 znaki. Dostepne typy tras to: h -wahadło, d - dostawa, hp - wahadło przyjazd, p - odbiór.',
            'freight.required' => 'Ilość miejsc paletowych jest wymagana. Należy podać ilośc z przedziału 1 do 66.',
            'freight.between' => 'Iloś miejsc paletowych musi byz z przedziału od 1 do 66',
            'eta.required' => 'Zaplanowana godzina przyjazdu/wyjazdu jest wymagana. Dane należy wprowadzic w formacie RRRR-MM-DD HH:MM.',
            'eta.date' => 'Dane należy wprowadzic w formacie RRRR-MM-DD HH:MM.',
            'eta.after' => 'Data wyjazdu trasy nie może być wcześniejsza niż aktualny dzień.',
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

//Track import from file
    public function import(Request $request)
    {
        Excel::import(new TrackImport, $request->file);
        return redirect(route('tower.index'))->with('status', 'Trasy zaimportowane');
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
            'track_type' => 'required|max:2',
            'freight' => 'required|numeric|between:1,66',
            'eta' => 'required|date|after:yesterday',
        ], [
            'vehicle_id.required' => 'Nr rejestracyjny pojazdu jest wymagany.',
            'vehicle_id.max' => 'Nr rejestracyjny nie może być dłuszy niż 20 znaków.',
            'track_type.required' => 'Typ trasy jest wymagany. Dostepne typy tras to: h -wahadło, d - dostawa, hp - wahadło przyjazd, p - odbiór.',
            'track_type.max' => 'Oznaczenie typu trasy nie może zawierać więcej niż 2 znaki. Dostepne typy tras to: h -wahadło, d - dostawa, hp - wahadło przyjazd, p - odbiór.',
            'freight.required' => 'Ilość miejsc paletowych jest wymagana. Należy podać ilośc z przedziału 1 do 66.',
            'freight.between' => 'Iloś miejsc paletowych musi byz z przedziału od 1 do 66',
            'eta.required' => 'Zaplanowana godzina przyjazdu/wyjazdu jest wymagana. Dane należy wprowadzic w formacie RRRR-MM-DD HH:MM.',
            'eta.date' => 'Dane należy wprowadzic w formacie RRRR-MM-DD HH:MM.',
            'eta.after' => 'Data wyjazdu trasy nie może być wcześniejsza niż aktualny dzień.',
        ]);
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $track = ControlTower::find($track_id);
            if (!ControlTower::where('task_end_exp', '=', $request->input($track->task_end_exp))->exists()) {
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
            } else {
                return response()->json(['code' => 1, 'msg' => 'Załadunek trasy został rozpoczęty. Zmian można dokonać w trybie Super Admin!']);
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
            'ramp' => 'required|max:5|unique:control_towers',
        ], [
            'ramp.required' => 'Rampa jest wymagana. Należy wybrać z listy.',
            'ramp.max' => 'Oznaczenie ramy nie może być dłuższe niż 5 znaków',
            'ramp.unique' => 'Rampa jest zajęta. Wybierz inną.',
        ]);
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $track = ControlTower::find($track_id);
            if (!ControlTower::where('ramp', '=', $request->input($track->ramp))->exists()) {
                $track->ramp = $request->ramp;
                $track->docked_at = Carbon::now();
                $query = $track->save();
                if ($query) {
                    return response()->json(['code' => 1, 'msg' => 'Samochód podstawiony pod rampę']);
                } else {
                    return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
                }
            } else {
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
        ], [
            'worker_id.required' => 'Wybierz ID pracownika z listy.',
            'worker_id.max' => 'ID pracownika może zawierać maksymalnie 5 znaków.'
        ]);
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $track = ControlTower::find($track_id);
            if (ControlTower::where('ramp', '=', $request->input($track->ramp))->exists()) {
                if (!ControlTower::where('worker_id', '=', $request->input($track->worker_id))->exists()) {
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
                } else {
                    return response()->json(['code' => 1, 'msg' => 'Uwaga! Operacja przeładunku została już rozpoczęta. Zmiany mozna dokonać w trybie edycji Super Admin']);
                }
            } else {
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
            if (ControlTower::where('task_start', '=', $request->input($track->task_start))->exists()) {
                if (!ControlTower::where('task_end', '=', $request->input($track->task_end))->exists()) {
                    $track->task_end = Carbon::now();
                    $query = $track->save();
                    if ($query) {
                        return response()->json(['code' => 1, 'msg' => 'Operacja przeładunku zakończona']);
                    } else {
                        return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
                    }
                } else {
                    return response()->json(['code' => 1, 'msg' => 'Uwaga! Operacja przeładunku została już zakończona. Edycji można dokonać w trybie Super Admin']);
                }
            } else {
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

        if ($track->eta < Carbon::now()) {
            $validator = \Validator::make($request->all(), [
                'comment' => 'required|string|max:255',
            ], [
                'comment.required' => 'Komentarz jest wymagany dla tras załadowanych z opóźnieniem oraz dla tras z przekroczonym przewidywanym czasem przeładunku.',
                'comment.max' => 'Maksymalna długość komentarza to 255 znaków.'
            ]);
            if (!$validator->passes()) {
                return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
            } else {
                $track = ControlTower::find($track_id);
                if (ControlTower::where('task_end', '=', $request->input($track->task_end))->exists()) {
                    if (!ControlTower::where('doc_ready', '=', $request->input($track->doc_ready))->exists()) {
                        $track->doc_ready = Carbon::now();
                        $track->comment = $request->comment;
                        $query = $track->save();
                        if ($query) {
                            return response()->json(['code' => 1, 'msg' => 'Dokumenty gotowe do odbioru. Uwaga! Trasa została załadowana z opóźnieniem.']);
                        } else {
                            return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
                        }
                    } else {
                        return response()->json(['code' => 1, 'msg' => 'Uwaga! Dokumenty zostały już zarejestrowane. Edycji można dokonać w trybie Super Admin']);
                    }
                } else {
                    return response()->json(['code' => 1, 'msg' => 'Uwaga! Nie można przygotować dokumentów. Trasa nie została załadowana.']);
                }
            }
        } else {
            $track = ControlTower::find($track_id);
            if (ControlTower::where('task_end', '=', $request->input($track->task_end))->exists()) {
                if (!ControlTower::where('doc_ready', '=', $request->input($track->doc_ready))->exists()) {
                    $track->doc_ready = Carbon::now();
                    $track->comment = $request->comment;
                    $query = $track->save();
                    if ($query) {
                        return response()->json(['code' => 1, 'msg' => 'Dokumenty gotowe do odbioru.']);
                    } else {
                        return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
                    }
                } else {
                    return response()->json(['code' => 1, 'msg' => 'Uwaga! Dokumenty zostały już zarejestrowane. Edycji można dokonać w trybie Super Admin']);
                }
            } else {
                return response()->json(['code' => 1, 'msg' => 'Uwaga! Nie można przygotować dokumentów. Trasa nie została załadowana.']);
            }
        }
    }

//Departure track get data
    public function getDepartureData(Request $request)
    {
        $track_id = $request->track_id;
        $trackDetails = ControlTower::find($track_id);
        return response()->json(['details' => $trackDetails]);
    }

//Departure track update data
    public function trackDeparted(Request $request)
    {
        $track_id = $request->cid_departure;
        $validator = \Validator::make($request->all(), [
        ]);
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $track = ControlTower::find($track_id);
            if (ControlTower::where('doc_ready', '=', $request->input($track->doc_ready))->exists()) {
                if (!ControlTower::where('departure', '=', $request->input($track->departure))->exists()) {
                    $track->departure = Carbon::now();
                    $newTrack = $track->replicate();
                    $newTrack->setTable('departures_control_towers');
                    $track->delete();
                    $query = $newTrack->save();
                    if ($query) {
                        return response()->json(['code' => 1, 'msg' => 'Operacja przeładunku zakończona, dokumenty wydane kierowcy. Trasa przeniesiona do widoku tras zakończonych.']);
                    } else {
                        return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
                    }
                } else {
                    return response()->json(['code' => 1, 'msg' => 'Uwaga! Operacja przeładunku została już zakończona. Edycji można dokonać w trybie Super Admin']);
                }
            } else {
                return response()->json(['code' => 1, 'msg' => 'Uwaga! Nie można zarejestrować wyjazdu trasy, ponieważ dokumenty do trasy nie zostały przygotowane.']);
            }
        }
    }

//Super Admin edit get track data
    public function getSaEditData(Request $request)
    {
        $track_id = $request->track_id;
        $trackDetails = ControlTower::find($track_id);
        return response()->json(['details' => $trackDetails]);
    }

//Super Admin update track data
    public function saUpdateData(Request $request)
    {
        $track_id = $request->cid_sa_track;
        $validator = \Validator::make($request->all(), [
            'vehicle_id' => 'required|max:20',
            'track_type' => 'required|max:5',
            'worker_id' => 'max:5',
            'docked_at' => 'date|nullable',
            'task_end' => 'date|nullable',
            'doc_ready' => 'date|nullable',
            'comment' => 'max:255|nullable',
            'departure' => 'date|nullable'
        ], [
            'vehicle_id.required' => 'Nr rejestracyjny pojazdu jest wymagany.',
            'vehicle_id.max' => 'Nr rejestracyjny nie może być dłuszy niż 20 znaków.',
            'track_type.required' => 'Typ trasy jest wymagany. Dostepne typy tras to: h -wahadło, d - dostawa, hp - wahadło przyjazd, p - odbiór.',
            'track_type.max' => 'Oznaczenie typu trasy nie może zawierać więcej niż 2 znaki. Dostepne typy tras to: h -wahadło, d - dostawa, hp - wahadło przyjazd, p - odbiór.',
            'worker_id.max' => 'ID pracownika może zawierać maksymalnie 5 znaków.',
            'docked_at.date' => 'Dane należy wprowadzic w formacie RRRR-MM-DD HH:MM.',
            'task_end.date' => 'Dane należy wprowadzic w formacie RRRR-MM-DD HH:MM.',
            'departure.date' => 'Dane należy wprowadzic w formacie RRRR-MM-DD HH:MM.',
            'comment.max' => 'Maksymalna długość komentarza to 255 znaków.'
        ]);
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $track = ControlTower::find($track_id);
            $track->vehicle_id = $request->vehicle_id;
            $track->track_type = $request->track_type;
            $track->freight = $request->freight;
            if ($track->isDirty('freight')) {
                $validator = \Validator::make($request->all(), [
                    'freight' => 'required|numeric|between:1,66'
                ], [
                    'freight.required' => 'Ilość miejsc paletowych jest wymagana. Należy podać ilośc z przedziału 1 do 66.',
                    'freight.between' => 'Iloś miejsc paletowych musi byz z przedziału od 1 do 66'
                ]);
                if (!$validator->passes()) {
                    return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
                } else {
                    $track->docking_plan = Carbon::parse($track->eta)->subMinutes($track->freight * 1.5 + 15);
                }
            }
            $track->eta = $request->eta;
            if ($track->isDirty('eta')) {
                $validator = \Validator::make($request->all(), [
                    'eta' => 'required|date'
                ], [
                    'eta.required' => 'Zaplanowana godzina przyjazdu/wyjazdu jest wymagana. Dane należy wprowadzic w formacie RRRR-MM-DD HH:MM.',
                    'eta.date' => 'Dane należy wprowadzic w formacie RRRR-MM-DD HH:MM.'
                ]);
                if (!$validator->passes()) {
                    return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
                } else {
                    $track->docking_plan = Carbon::parse($track->eta)->subMinutes($track->freight * 1.5 + 15);
                }
            }
            $track->docked_at = $request->docked_at;
            $track->worker_id = $request->worker_id;
            $track->ramp = $request->ramp;
            if ($track->isDirty('ramp')) {
                $validator = \Validator::make($request->all(), [
                    'ramp' => 'nullable|max:5|unique:control_towers'
                ], [
                    'ramp.required' => 'Rampa jest wymagana. Należy wybrać z listy.',
                    'ramp.max' => 'Oznaczenie ramy nie może być dłuższe niż 5 znaków',
                    'ramp.unique' => 'Rampa jest zajęta. Wybierz inną.',
                ]);
                if (!$validator->passes()) {
                    return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
                } else {
                    $track->ramp = $request->ramp;
                }
            }
            $track->task_start = $request->task_start;
            if ($track->isDirty('task_start')) {
                $validator = \Validator::make($request->all(), [
                    'task_start' => 'date|nullable'
                ], [
                    'task_start.date' => 'Dane należy wprowadzic w formacie RRRR-MM-DD HH:MM.'
                ]);
                if (!$validator->passes()) {
                    return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
                } else {
                    $track->task_start = $request->task_start;
                    $track->task_end_exp = Carbon::parse($track->task_start)->addMinutes($track->freight * 1.5 + 15);
                    $track->doc_return_exp = Carbon::parse($track->eta)->subMinutes(15);
                }
            }
            $track->task_start = $request->task_start;
            $track->task_end = $request->task_end;
            $track->doc_ready = $request->doc_ready;
            $track->comment = $request->comment;
            $track->departure = $request->departure;
            $query = $track->save();
            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Zmiany w trasie zostały wprowadzone']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
            }
        }
    }

    public function areaReady(Request $request)
    {
        $track = ControlTower::find($request->track_id);
        $track->area = $request->area;
        $track->area_arrived = Carbon::now();
        $query = $track->save();
        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Status gotowości do przeładunku został zmieniony.']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
        }
    }
}
