<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cemetery extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_cemeteries');
    }
}
