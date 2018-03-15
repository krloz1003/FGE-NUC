<?php

use Illuminate\Database\Seeder;

class FolioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Folio::class, 100)->create();
    }
}
