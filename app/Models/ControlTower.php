<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlTower extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vehicle_id',
        'track_id',
        'track_type',
        'freight',
        'eta',
        'docking_plan',
        'docked_at',
        'worker_id',
        'ramp',
        'task_start',
        'task_end_exp',
        'doc_return_exp',
        'task_end',
        'doc_ready',
        'comment',
    ];
}
