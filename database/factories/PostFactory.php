<?php

use Faker\Generator as Faker;
use \Cviebrock\EloquentSluggable\Services\SlugService;

$factory->define(App\Post::class, function (Faker $faker) {
	$title = $faker->sentence();
	return [
		'title' => $title,
        'slug' => SlugService::createSlug(App\Post::class, 'slug', $title),
    	'is_active' =>  $faker->numberBetween(0, 1),
    	'content' => $faker->paragraph(20),
		'category_id' => $faker->numberBetween(1, 3),
	];
});
