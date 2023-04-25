<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $guarded = [];
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
