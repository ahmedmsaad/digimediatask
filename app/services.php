<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    public function client() {
        return $this -> belongsTo(clients::class);
    }
}
