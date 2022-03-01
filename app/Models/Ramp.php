<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Monolog\Handler\OverflowHandler;

class Ramp extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'power',
    ];
    public function ram(): HasOne
    {
        return $this->hasOne(ControlTower::class)->withDefault();
    }
    public function stat(): BelongsTo
    {
        return $this->belongsTo(RampStatus::class,'status');
    }
    public function dram(): HasOne
    {
        return $this->hasOne(DeparturesControlTower::class)->withDefault();
    }
}
