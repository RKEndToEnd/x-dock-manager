<?php

namespace App\Http\Controllers;

use App\Models\DeparturesControlTower;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DeparturesControlTowerController extends Controller
{

    public function index()
    {
        return view('departed_tracks.index');
    }
//Get all tracks
    public function getDepartedTrackList()
    {
        $tracks = DeparturesControlTower::all();
        return DataTables::of($tracks)
            ->addIndexColumn()
            ->addColumn('actions', function($row){
                return '<div>
                            <button class="btn btn-sm btn-outline-danger" data-id="' . $row['id'] . '" id="deleteDepartedTrackBtn"><i class="fas fa-trash"></i></button>
                        </div>';
            })
            ->setRowClass(function ($row) {
                if ($row->eta < $row->doc_ready)
                    return 2 == 0 ? '' : 'alert-danger';

                else if ($row->eta > $row->doc_ready)
                    return 2 == 0 ? '' : 'alert-success';
            })
            ->rawColumns(['actions'])
            ->make(true);

    }
}
