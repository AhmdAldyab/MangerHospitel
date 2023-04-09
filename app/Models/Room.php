<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable=['name','description','section_id'];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
