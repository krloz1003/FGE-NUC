<?php

use Illuminate\Database\Seeder;
use App\Modulo;

class ModuloTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$modulos = array(
        	['nombre' => 'CIPP'],
        	['nombre' => 'UAT'],
        	['nombre' => 'REMASC'],        	
        );

        foreach ($modulos as $modulo) {
        	Modulo::create($modulo);
        }

    }
}
