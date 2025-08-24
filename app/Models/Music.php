<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Music extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
      'id',
      'user_id',
      'title',
      'description',
      'text',
      'music_src',
      'role',
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
           $model->id = (string)Str::uuid();
        });
    }
}
