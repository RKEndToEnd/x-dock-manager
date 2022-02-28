<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LiveTowerResource;
use App\Models\ControlTower;

class TowerController extends Controller
{
    public function towerLive()
    {
        return LiveTowerResource::collection(ControlTower::all());
    }
}
