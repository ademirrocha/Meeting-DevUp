<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Reunioes;

class Ata extends Model
{

	protected $table = 'atas';

    protected $fillable = [
        'reuniao_id',
        'ata',
    ];

    public function reuniao(){
    	return $this->hasOne(Reunioes::class);
    }
}
