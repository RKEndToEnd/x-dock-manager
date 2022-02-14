<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array[]
     */
    protected $fillable = [
        'name',
        'surname',
        'custom_id',
        'role',
        'email',
        'depot_id',
        'password',
    ];

    public function depot(): BelongsTo
    {
        return $this->belongsTo(Depot::class);
    }
    public function id(): HasMany
    {
        return $this->hasMany(ControlTower::class);
    }
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->worker_id = User::where($model->worker_id)->max('worker_id')+1;
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
