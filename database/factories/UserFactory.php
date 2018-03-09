<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Nuc::class, function(Faker $faker) {

    $nuc = App\Nuc::orderby('nuc','DESC')->take(1)->pluck('nuc');
    $numero = (int)substr($nuc,4,6);
    $numero = $numero+1;
    $numero = str_pad($numero, 6, "0", STR_PAD_LEFT);

	$nuc = Carbon::now()->formatLocalized('%y').$numero.$faker->bothify('#?#?#?');
	return[
		'nuc' => $nuc	
	];
});



$factory->define(App\Folio::class, function(Faker $faker) {
	$numero = $faker->unique()->bothify('FGE-####????');
	$nucs 		= App\Nuc::all();
	$modulos 	= App\Modulo::all();

	return[
		'numero' => $numero,
		'id_nuc' => (count($nucs) > 0) ? $faker->randomElement($nucs->pluck('id_nuc')->toArray()) : 0,
		'id_modulo' => (count($modulos) > 0) ? $faker->randomElement($modulos->pluck('id_modulo')->toArray()) : 0,	
	];
});
