<?php

namespace App\Http\Controllers;

use App\Exports\DepartedTracksExport;
use App\Models\DeparturesControlTower;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DeparturesControlTowerController extends Controller
{

    public function index()
    {
        return view('departed_tracks.index');
    }

//Get all tracks
    public function getDepartedTrackList(Request $request)
    {
        if ($request->ajax()) {
            $tracks = DeparturesControlTower::with('dtrace', 'dids');
            return DataTables::of($tracks)
                ->addIndexColumn()
                ->addColumn('dids', function (DeparturesControlTower $departure) {
                    return $departure->dids->worker_id;
                })
                ->addColumn('dtrace', function (DeparturesControlTower $ramp) {
                    return $ramp->dtrace->name;
                })
                ->addColumn('actions', function ($row) {
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

//Export to excel
    public function export()
    {
        return new DepartedTracksExport;
    }

    public function etaFilter(Request $request)
    {
        $start_date = $request->input('eta_date_start');
        $end_date = $request->input('eta_date_end');
        $query = DB::table('departures_control_towers')->whereBetween('eta', [$start_date, $end_date])->get();

        return DataTables::of($query)->make(true);
     //      return view('departed_tracks.index',compact('query'));
    }
}
