<?php

namespace App\Http\Controllers;

use App\Models\Depot;
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
            ->rawColumns(['actions'])
            ->make(true);
    }
}
