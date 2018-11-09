<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public function jokes(){
        return $this->hasMany(jokes::class);
    }
}
