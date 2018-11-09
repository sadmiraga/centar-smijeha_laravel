<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jokes extends Model
{
    public function category(){
        return $this->belongsTo(category::class);
    }
}


 