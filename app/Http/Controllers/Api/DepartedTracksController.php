<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartedTracksResource;
use App\Models\DeparturesControlTower;

class DepartedTracksController extends Controller
{
    public function departedTracks()
    {
        return DepartedTracksResource::collection(DeparturesControlTower::all());
    }
}
