<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Niche extends Model
{
    /**
     * Get the niche's full category.
     *
     * @return string
     */
    public function getCategoryAttribute($value)
    {
       switch ($value) {
           case 'A':
               return 'Adulto';
               break;
           case 'P':
               return 'Parvulo';
               break;
            case 'O':
               return 'Osario';
               break;
            case 'D':
                return 'Dorado';
                break;
           default:
               return 'Otro';
               break;
       }
    }

    /**
     * Get the niche's full state.
     *
     * @return string
     */
    public function getStateAttribute($value)
    {
        switch ($value) {
            case 'D':
                return 'Disponible';
                break;
            case 'T':
                return 'Tramite';
                break;
             case 'O':
                return 'Ocupado';
                break;
             case 'R':
                 return 'Reservado';
                 break;
            default:
                return 'Otro';
                break;
        }
    }
    
    public function pavilion()
    {
        return $this->belongsTo(Pavilion::class);
    }
}
