<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Organizacao;

class Organizacao extends Model
{
    protected $table = 'organizacoes';


    protected $fillable = [
        'razao_social', 'cnpj', 'fantasia', 'meeting_confirmed',
    ];

    protected $primaryKey = 'id';


    
    

    
    protected function registeredOk(){
        $organizacao = Organizacao::find(auth()->user()->organizacao_id);
        
        if($organizacao->fantasia != 'Nenhuma' && auth()->user()->organizacao_confirmed == 1 ){
            return true;
        }else{
            return false;
        }
    }


    
}
