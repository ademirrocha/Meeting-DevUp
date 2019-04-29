<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Organizacao;
use App\USer;
use App\Models\Reunioes;

class Organizacao extends Model
{
    protected $table = 'organizacoes';


    protected $fillable = [
        'razao_social', 'cnpj', 'fantasia', 'meeting_confirmed',
    ];

    protected $primaryKey = 'id';

    //relacionamento entre organizacao e users
    public function users(){
        return $this->hasMany(User::class);
    }


    //relacionamento entre organização e Localizaçoes
    public function localizacoes(){
        return $this->hasMany(Localizacao::class, 'organizacao_id');
    }


    //relacionamento entre organização e reunioes
    public function reunioes(){
        return $this->hasMany(Reunioes::class);
    }


    

    
    protected function registeredOk(){
        $organizacao = Organizacao::find(auth()->user()->organizacao_id);
        
        if($organizacao->fantasia != 'Nenhuma' && auth()->user()->organizacao_confirmed == 1 ){
            return true;
        }else{
            return false;
        }
    }


    
}
