<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];
    
    public function events()
    {
        return $this->belongsTo(Event::class);
    }
}
