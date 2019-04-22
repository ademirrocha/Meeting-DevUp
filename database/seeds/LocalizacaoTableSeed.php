<?php

use Illuminate\Database\Seeder;
use App\Models\Localizacao;

class LocalizacaoTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $localizacao = Localizacao::get();
 
        if($localizacao->count() == 0) {

            Localizacao::create([
            	'organizacao_id' => 2,
                'nome' => 'Sala dos Professores - IFNMG - Campus Arinos',  
            ]);
        }
    }
}
