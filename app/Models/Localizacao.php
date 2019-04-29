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

    //relacionamento entre Localizaçao e organização
	public function organizacao(){
        return $this->belongsTo(Organizacao::class, 'organizacao_id');
    }


    public function local(){
        return $this->belongsTo(Localizacao::class, 'organizacao_id');
    }



}
