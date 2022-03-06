<?php

namespace App\Http\Controllers;

use App\Models\RampStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RampStatusController extends Controller
{
    public function statuses()
    {
        return view('ramps.status');
    }

//Get all statuses
    public function getStatusesList()
    {
        $statuses = RampStatus::all();
        return DataTables::of($statuses)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                if (Auth::user()->hasrole('super-admin')) {
                    return '<button class="btn btn-sm btn-outline-warning" data-id="' . $row['id'] . '" id="editStatusBtn" title="Edycja ststusu rampy"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-id="' . $row['id'] . '" id="deleteStatusBtn" title="Usuwanie statusu rampy"><i class="fas fa-trash"></i></button>
                        ';
                }
                if (Auth::user()->hasrole('admin')) {
                    return '<button class="btn btn-sm btn-outline-warning" data-id="' . $row['id'] . '" id="editStatusBtn"title="Edycja statusu rampy"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger" data-id="' . $row['id'] . '" id="deleteStatusBtn" title="Usuwanie statusu rampy" disabled><i class="fas fa-trash"></i></button>
                        ';
                }
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

//Create new ramp status
    public function createStatus(Request $request)
    {
        $status_id = $request->cid_create_ramp;
        $validator = \Validator::make($request->all(), [
            'status' => 'required|max:50|unique:ramp_statuses',
        ]);
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $status = new RampStatus($request->all());
            $status->status = $request->status;
            $query = $status->save();
            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Status został dodany do bazy danych']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
            }
        }
    }

//Delete ramp
    public function deleteStatus(Request $request)
    {
        $status_id = $request->status_id;
        $query = RampStatus::find($status_id)->delete();
        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Status został usuniety z bazy danych']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Wystapił nieoczekiwany błąd']);
        }
    }

//Get status details
    public function getStatusDetails(Request $request)
    {
        $status_id = $request->status_id;
        $statusDetails = RampStatus::find($status_id);
        return response()->json(['details' => $statusDetails]);
    }
//Update depot details
    public function updateStatusDetails(Request $request){
        $status_id = $request->cid_edit_status;
        $validator = \Validator::make($request->all(),[
            'status'=>'required|string|unique:ramp_statuses|max:50',
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $status = RampStatus::find($status_id);
            $status->status = $request->status;
            $query = $status->save();
            if ($query){
                return response()->json(['code'=>1,'msg'=>'Opis statusu został zaktualizowany']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Wystąpił nieoczekiwany błąd']);
            }
        }
    }
}
