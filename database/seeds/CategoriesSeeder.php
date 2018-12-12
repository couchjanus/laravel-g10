<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     DB::table('categories')->insert([
    //         'name' => str_random(100)
    //         ]);
    // }

    public function run()
    {
    
        $categoriesData = array(
            array('name' => 'artisan'),
            array('name' => 'php'),
            array('name' => 'laravel'),
        );

        // Удаляем предыдущие данные
        DB::table('categories')->delete();
        // DB::table('posts')->delete();
        
        foreach ($categoriesData as $cat) {
            DB::table('categories')->insert([
                'name' => $cat['name']
            ]);
        }
    }

}
