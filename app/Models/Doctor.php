<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $guarded = [];
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
    public function specializtion()
    {
        return $this->belongsTo(specialization::class, 'Specialization_id');
    }
}
