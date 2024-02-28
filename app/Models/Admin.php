<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_password_reset_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function boot() {

        parent::boot();

        static::creating(function($model) {

            $model->attributes['unique_id'] = uniqid();
        });

        static::created(function($model) {

            $model->attributes['unique_id'] = "A-".str_pad($model->attributes['id'], 5, 0, STR_PAD_LEFT)."-".$model->attributes['unique_id'];

            $model->save();
        });
    }
}
