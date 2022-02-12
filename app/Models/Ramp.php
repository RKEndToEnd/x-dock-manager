<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    public function ram(): BelongsTo
    {
        return $this->belongsTo(ControlTower::class,'ramp');
    }
    public function stat(): BelongsTo
    {
        return $this->belongsTo(RampStatus::class,'status');
    }
}
