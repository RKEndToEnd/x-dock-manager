<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use http\Env\Response;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepotController extends Controller
{
    public function index()
    {
        return view('depots.index');
    }
    //Get all depots
    public function getDepotsList()
    {
        $depots = Depot::all();
        return DataTables::of($depots)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                return '<div class="btn-group">
                            <button class="btn btn-sm btn-warning" data-id="'.$row['id'].'" id="editDepotBtn">E</button>
                            <button class="btn btn-sm btn-danger" data-id="'.$row['id'].'" id="deleteDepotBtn">X</button>
                        </div>';
            })
            /*->addColumn('traffic', function ($row){
                return '<div class="btn-group">
                            <button class="btn btn-sm btn-outline-success" data-id="'.$row['id'].'" id="trafficBtn">MAP</button>
                        </div>';
            })*/
            ->rawColumns(['actions'])
            ->make(true);
    }
    //Create new depot
    public function createDepot(Request $request)
    {
        $depot_id = $request->cid_depot;
        $validator = \Validator::make($request->all(),[
            'name'=>'required|string|unique:depots|max:5',
            'city'=>'required|string|max:50',
            'map_link'=>'string|max:300|nullable',
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else {
            $depot = new Depot($request->all());
            $depot->name = $request->name;
            $depot->city = $request->city;
            /*$depot->map_link = $request->map_link;*/
            $query = $depot->save();
            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Depot został dodany do bazy danych']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
            }
        }
    }
    //Get depot details
    public function getDepotDetails(Request $request)
    {
        $depot_id = $request->depot_id;
        $depotDetails = Depot::find($depot_id);
        return response()->json(['details'=>$depotDetails]);
    }
    //Update depot details
    public function updateDepotDetails(Request $request){
        $depot_id = $request->cid_depot;
        $validator = \Validator::make($request->all(),[
            'name'=>'required|string|unique:depots|max:5',
            'city'=>'required|string|max:50',
            'map_link'=>'string|max:300|nullable',
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $depot = Depot::find($depot_id);
            $depot->name = $request->name;
            $depot->city = $request->city;
            $query = $depot->save();
            if ($query){
                return response()->json(['code'=>1,'msg'=>'Dane depotu zostały zaktualizowane']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Wystąpił nieoczekiwany błąd']);
            }
        }
    }
    //Delete depot
    public function deleteDepot(Request $request){
        $depot_id = $request->depot_id;
        $query = Depot::find($depot_id)->delete();
        if ($query){
            return response()->json(['code'=>1,'msg'=>'Depot został usuniety z bazy danych']);
        }else{
            return response()->json(['code'=>0,'msg'=>'Wystapił nieoczekiwany błąd']);
        }
    }
    //View map ONLY FOR TESTING
    /*public function getMap(Request $request)
    {
        $depot_map = $request->depot_map;
        $depotDetails = Depot::find($depot_map);
        return response()->json(['details'=>$depotDetails]);
    }*/
}
