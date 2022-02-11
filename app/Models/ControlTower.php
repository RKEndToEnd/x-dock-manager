<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'ramp',
        'worker_id',
        'task_start',
        'task_end_exp',
        'doc_return_exp',
        'task_end',
        'doc_ready',
        'comment',
        'departure',
    ];
    public function track(): HasMany
    {
        return $this->hasMany(Ramp::class);
    }
}
