<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
    public function services()
    {
        return $this->hasMany(services::class);
    }
    public function socialMedia() {
        return $this -> belongsToMany(socialMedia::class);
    }
}
