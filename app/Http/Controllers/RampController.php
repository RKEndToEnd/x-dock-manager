<?php

namespace App\Http\Controllers;

use App\Models\Ramp;
use http\Env\Response;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RampController extends Controller
{
    public function index()
    {
        return view('ramps.index');
    }
//Get all ramps
    public function getRampsList()
    {
        $ramps = Ramp::all();
        return DataTables::of($ramps)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<button class="btn btn-sm btn-outline-danger" data-id="'. $row['id'].'" id="deleteRampBtn"><i class="fas fa-trash"></i></button>
                        ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
//Create new ramp
    public function createRamp(Request $request)
    {
        $ramp_id = $request->cid_create_ramp;
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:5|unique:ramps',
            'status' => 'required|max:10',
            'power' => 'required|max:20',
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0, 'error' =>$validator->errors()->toArray()]);
        }else{
            $ramp = new Ramp($request->all());
            $ramp->name = $request->name;
            $ramp->status = $request->status;
            $ramp->power = $request->power;
            $query = $ramp->save();
            if ($query){
                return response()->json(['code' => 1, 'msg' => 'Rampa została dodana do bazy danych']);
            }else{
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
}