<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reunioes;
use App\Models\Localizacao;

class Reunioes extends Model
{
     
    protected $fillable = [
        'user_id',
        'localizacao_id',
        'organizacao_id',
        'pauta',
        'data_inicio',
        'data_fim',
    ];


    protected $primaryKey = 'id';


    

   
    

}
