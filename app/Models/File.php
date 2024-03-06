<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function user() {

        return $this->belongsTo(User::class)->withDefault();
    }

    public function folder() {

        return $this->belongsTo(Folder::class)->withDefault();
    }

    public static function boot() {

        parent::boot();

        static::creating(function($model) {

            $model->attributes['unique_id'] = uniqid();
        });

        static::created(function($model) {

            $model->attributes['unique_id'] = "File-".str_pad($model->attributes['id'], 5, 0, STR_PAD_LEFT)."-".$model->attributes['unique_id'];

            $model->save();
        });

        static::deleted(function($model) {

            Helper::delete_file($model->url, FILE_BANK_FILE_PATH);
        });
    }
}
