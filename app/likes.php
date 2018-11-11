<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class likes extends Model
{
    public function User(){
        return $this->belongsTo(User::class);
    }

    public function jokes(){
        return $this->belongsTo(jokes::class);
    }
}
