<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::get();
 
        if($user->count() == 0) {

            User::create([
                'id' => 1,
            	'organizacao_id' => 2,
                'organizacao_confirmed' => 1,
            	'nome' => 'Admin do Meeting',
            	'cargo_id' => 2,
                'email' => 'admin@meeting.com',
                'cpf'     => '00000000000',
                'password' => bcrypt('12345678'),   
            ]);


            User::create([
                'id' => 2,
                'organizacao_id' => 3,
                'organizacao_confirmed' => 1,
                'nome' => 'Ademir Rocha',
                'cargo_id' => 2,
                'email' => 'tiademir.rocha93@gmail.com',
                'cpf'     => '00000000000',
                'password' => bcrypt('12345678'),   
            ]);
        }
    }
}
