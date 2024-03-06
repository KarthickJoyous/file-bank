<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Folder extends Model
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

    public function subFolder() {

        return $this->belongsTo(Folder::class, 'sub_folder')->withDefault();
    }

    public function subFolders() {

        return $this->hasMany(Folder::class, 'sub_folder');
    }

    public function files() {

        return $this->hasMany(File::class);
    }
    
    public static function boot() {

        parent::boot();

        static::creating(function($model) {

            $model->attributes['unique_id'] = uniqid();
        });

        static::created(function($model) {

            $model->attributes['unique_id'] = "Folder-".str_pad($model->attributes['id'], 5, 0, STR_PAD_LEFT)."-".$model->attributes['unique_id'];

            $model->save();
        });

        static::deleted(function($model) {

            foreach($model->subFolders() as $sub_folder) {

                $sub_folder->delete();
            }

            foreach($model->files() as $file) {

                $file->delete();
            }
        });
    }
}
