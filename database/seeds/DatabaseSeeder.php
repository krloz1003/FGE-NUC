<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NucTableSeeder::class);
        $this->call(ModuloTableSeeder::class);
        $this->call(FolioTableSeeder::class);
        
    }
}
