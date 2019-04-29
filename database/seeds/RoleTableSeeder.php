<?php

use Illuminate\Database\Seeder;

use App\Models\Permissoes\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
        		'id' => 1,
            	'nome' => 'super_admin',
                'label' => 'Administrador do Sistema Meenting',
                
            ]);

        Role::create([
        		'id' => 2,
            	'nome' => 'admin',
                'label' => 'Administrador de TI',
            ]);

        Role::create([
        		'id' => 3,
            	'nome' => 'usuario',
                'label' => 'Usuário do Sistema',
            ]);

        Role::create([
                'id' => 4,
                'nome' => 'unauthorized',
                'label' => 'Usuário ou Organização Não Autorizados',
            ]);



    
        DB::table('role_user')->insert([
            ['role_id' => 1, 'user_id' => 1],
            ['role_id' => 2, 'user_id' => 2],
        ]);

    }
}
