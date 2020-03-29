<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pavilion extends Model
{
    /**
     * Get the pavilion's full type.
     *
     * @return string
     */
    public function getTypeAttribute($value)
    {
        if ($value == 'N') {
            return 'Nicho'; 
        }
        
        return 'Mausoleo'; 
    }
}
