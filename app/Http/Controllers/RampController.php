<?php

namespace App\Http\Controllers;

use App\Models\Ramp;
use App\Models\RampStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ramps.index', ['ramp_statuses' => RampStatus::all()]);
    }

//Get all ramps
    public function getRampsList(Request $request)
    {
        if ($request->ajax()) {
            $ramps = Ramp::with(['stat']);
            return DataTables::of($ramps)
                ->addIndexColumn()
                ->addColumn('status', function (Ramp $ramp) {
                    return $ramp->stat->status;
                })
                ->addColumn('actions', function ($row) {
                    if(Auth::user()->hasrole('super-admin')) {
                        return '<button class="btn btn-sm btn-outline-warning" data-id="' . $row['id'] . '" id="statusRampBtn" title="Edycja danych rampy"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-outline-danger" data-id="' . $row['id'] . '" id="deleteRampBtn"><i class="fas fa-trash" title="Usuwanie rampy"></i></button>
                        ';
                    }
                    if(Auth::user()->hasrole('admin')) {
                        return '<button class="btn btn-sm btn-outline-warning" data-id="' . $row['id'] . '" id="statusRampBtn" title="Edycja danych rampy"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-outline-danger" data-id="' . $row['id'] . '" id="deleteRampBtn"><i class="fas fa-trash" title="Usuwanie rampy"></i></button>
                        ';
                    }
                })
                ->setRowClass(function ($row){
                    if ($row->status == '1')
                        return 2 == 0 ? '' : 'alert-success';
                    else if ($row->status == 2)
                        return 2 == 0 ? '' : 'alert-warning';
                    else if ($row->status == 3)
                        return 2 == 0 ? '' : 'alert-dark';
                    else if ($row->status == 4)
                        return 2 == 0 ? '' : 'alert-danger';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

//Create new ramp
    public function createRamp(Request $request)
    {
        $ramp_id = $request->cid_create_ramp;
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:5|unique:ramps',
            'status' => 'required|max:50',
            'power' => 'required|max:20',
        ],[
            'name.required' => 'Wpisz nazwę / oznaczenie rampy.',
            'name.max' => 'Dopuszczalna ilość znaków: 5.',
            'name.unique' => 'Rampa istnieje. Wybierz inną nazwę / oznaczenie.',
            'status.required' => 'Wybierz status rampy z listy.',
            'power.required' => 'Wybierz z listy.'
        ]);
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $ramp = new Ramp($request->all());
            $ramp->name = $request->name;
            $ramp->status = $request->status;
            $ramp->power = $request->power;
            $query = $ramp->save();
            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Rampa została dodana do bazy danych']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
            }
        }
    }
//Delete ramp
    public function deleteRamp(Request $request)
    {
        $ramp_id = $request->ramp_id;
        $query = Ramp::find($ramp_id)->delete();
        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Rampa została usunieta z bazy danych']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Wystapił nieoczekiwany błąd']);
        }
    }
//Get status details
    public function getRampStatus(Request $request)
    {
        $statusRamp_id = $request->statusRamp_id;
        $statusRampDetails = Ramp::find($statusRamp_id);
        return response()->json(['details' => $statusRampDetails]);
    }
//Update ramp details
    public function updateRampStatus(Request $request) {
        $statusRamp_id = $request->cid_edit_ramp;

        $validator = \Validator::make($request->all(),[
            'status'=>'required|string|max:50',
            'power'=>'required|string|max:20',
        ],[
            'status.required' => 'Wybierz status rampy z listy.',
            'power.required' => 'Wybierz z listy.'
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $statusRamp = Ramp::find($statusRamp_id);
            $statusRamp->status = $request->status;
            $statusRamp->power = $request->power;
            $query = $statusRamp->save();
            if ($query){
                return response()->json(['code'=>1,'msg'=>'Dane rampy zostały zaktualizowane']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Wystąpił nieoczekiwany błąd']);
            }
        }
    }
}

