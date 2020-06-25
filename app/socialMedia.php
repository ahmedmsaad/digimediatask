<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class socialMedia extends Model
{
    //
    public function clients() {
        return $this -> belongsToMany(clients::class);
    }
}
