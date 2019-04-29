<?php

use Illuminate\Database\Seeder;


use App\Models\Permissoes\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	################################ Permissões Para Organizacao  ##########################################

        Permission::create(['nome' => 'create_organizacao', 'label' => 'Cadastrar Organização']);

       Permission::create(['nome' => 'update_organizacao', 'label' => 'Editar Organização']);

        Permission::create(['nome' => 'view_organizacao', 'label' => 'Visualizar a Própria Organização',]);

        Permission::create(['nome' => 'view_organizacoes', 'label' => 'Visualizar Qualquer Organizacao Organização',]);

        Permission::create(['nome' => 'delete_organizacao', 'label' => 'Deletar Organização',]);

        Permission::create(['nome' => 'confirmar_organizacao', 'label' => 'Confirmar Organização',]);



        ################################ Permissões Para Reunioes  ##########################################

        Permission::create(['nome' => 'update_reuniao', 'label' => 'Editar a Própria Reunião', ]);
        
        Permission::create(['nome' => 'update_reunioes', 'label' => 'Editar Todas Reuniões', ]);

        Permission::create(['nome' => 'view_reuniao', 'label' => 'Visualizar Reunião', ]);

        Permission::create(['nome' => 'delete_reuniao', 'label' => 'Deletar Reunião', ]);




        ################################ Permissões Para Users  ##########################################

        Permission::create(['nome' => 'update_user', 'label' => 'Editar o Próprio Usuário', ]);

        Permission::create(['nome' => 'update_users', 'label' => 'Editar Todos os Usuário', ]);



        Permission::create(['nome' => 'view_user', 'label' => 'Visualizar Usuário', ]);

        Permission::create(['nome' => 'delete_user', 'label' => 'Deletar Usuário', ]);

        Permission::create(['nome' => 'confirmar_user', 'label' => 'Confirmar Usuário',]);



        


       
    }
}
