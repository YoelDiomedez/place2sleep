<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exhumation extends Model
{
    public function inhumation()
    {
        return $this->belongsTo(Inhumation::class);
    }
}
