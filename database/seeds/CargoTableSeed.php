<?php

use Illuminate\Database\Seeder;
use App\Models\Cargo;

class CargoTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargo = Cargo::get();
        
        if($cargo->count() == 0) {

            Cargo::create([
                'id' => 1,
                'cargo' => 'Indefinido',
              
            ]);

            Cargo::create([
                'id' => 2,
                'cargo' => 'Gerente/TI',
              
            ]);

        }
    }
}
