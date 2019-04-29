<?php

use Illuminate\Database\Seeder;
use App\Models\Organizacao;

class OrganizacaoTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizao = Organizacao::get();
 
        if($organizao->count() == 0) {

        	Organizacao::create([
        		'id' => 1,
                'razao_social' => 'Nenhuma',
                'cnpj' => '0000000',
                'fantasia' => 'Nenhuma'
                
            ]);

            Organizacao::create([
            	'id' => 2,
                'meeting_confirmed' => 1,
            	'razao_social' => 'Meeting Enterprise',
                'cnpj' => '0000000',
                'fantasia' => 'Meeting Enterprise'
                
            ]);

            


            Organizacao::create([
            	'id' => 3,
            	'meeting_confirmed' => 1,
                'razao_social' => 'Equipe Dev - BSI',
            	'cnpj' => '00000000000000000',
            	'fantasia' => 'Equipe Dev - BSI'
            	
            ]);


            
        }
    }
}
