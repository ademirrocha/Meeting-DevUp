<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reunioes;
use App\Models\Localizacao;
use App\Models\Organizacao;
use App\Models\Ata;
use App\User;

use Illuminate\Support\Facades\DB;

class Reunioes extends Model
{
     
    protected $fillable = [
        'user_id',
        'localizacao_id',
        'organizacao_id',
        'title',
        'tipo',
        'data_inicio',
        'data_fim',
    ];


    protected $primaryKey = 'id';


    //relacionamento entre Reuniao e organização
	public function organizacao(){
        return $this->belongsTo(Reuniao::class);
    }


    //relacionamento facilitdor
    public function facilitador(){
        return $this->belongsTo(User::class);
    }


    public function local(){
        return $this->belongsTo(Localizacao::class, 'localizacao_id');
    }

    protected function pautas($id){

       $pautas = DB::table('pautas')->where('reuniao_id', $id)->get();

       return $pautas;
    }

   
    public function reunioes(){
        return $this->belongsTo(Organizacao::class);
    }

    public function ata(){
        return $this->hasOne(Ata::class, 'reuniao_id');
    }

}
