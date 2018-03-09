<?php

use Illuminate\Database\Seeder;
use App\Nuc;

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

        //factory(App\Nuc::class, 10)->create();
        $faker = Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {

            $nuc = Nuc::orderby('nuc','DESC')->take(1)->pluck('nuc');
            $numero = (int)substr($nuc,4,6);
            $numero = $numero+1;
            $numero = str_pad($numero, 6, "0", STR_PAD_LEFT);
            $numero =  Carbon\Carbon::now()->formatLocalized('%y').$numero.$faker->bothify('#?#?#?');            
            
            $nuc = new Nuc();
            $nuc->nuc = $numero;
            $nuc->save();
        }       
    }
}
