<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Helpers\Helper;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'email_verified_at' => 'datetime',
        'last_password_reset_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function passbook() {

        return $this->hasOne(Passbook::class)->withDefault();
    }

    public static function boot() {

        parent::boot();

        static::creating(function($model) {

            $model->attributes['unique_id'] = uniqid();
        });

        static::created(function($model) {

            $model->attributes['unique_id'] = "U-".str_pad($model->attributes['id'], 5, 0, STR_PAD_LEFT)."-".$model->attributes['unique_id'];

            $model->save();

            Passbook::Create(['user_id' => $model->attributes['id']]);
        });

        static::deleted(function($model) {

            Helper::delete_file($model->avatar,  USER_FILE_PATH);

            $model->tokens()->delete();
        });
    }
}
