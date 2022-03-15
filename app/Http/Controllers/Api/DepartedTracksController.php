<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartedTracksResource;
use App\Models\DeparturesControlTower;
use Illuminate\Support\Facades\Cache;

class DepartedTracksController extends Controller
{
    public function departedTracks()
    {
        return DepartedTracksResource::collection(Cache::remember('dep', 60 * 60 * 24, function () {
            return DeparturesControlTower::all();
        }));
    }
}
