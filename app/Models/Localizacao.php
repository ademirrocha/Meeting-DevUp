<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Localizacao;

class Localizacao extends Model
{
    
    protected $table = 'localizacoes';

    protected $fillable = [
        'organizacao_id', 'nome',
    ];

    

}
