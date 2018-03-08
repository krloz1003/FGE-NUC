<?php

use Illuminate\Database\Seeder;

class NucTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //App\Nuc::truncate();

        factory(App\Nuc::class, 10)->create();
    }
}
