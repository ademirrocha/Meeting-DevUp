<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pautas extends Model
{
    

    public function reuniao(){
        return $this->belongsTo(Reunioes::class, 'reuniao_id');
    }

}
