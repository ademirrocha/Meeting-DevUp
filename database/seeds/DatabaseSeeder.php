<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

        $this->call(OrganizacaoTableSeed::class);

        $this->call(CargoTableSeed::class);

        $this->call(UsersTableSeeder::class);

        
        $this->call(LocalizacaoTableSeed::class);


    }
}
