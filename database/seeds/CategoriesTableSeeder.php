<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=['HTML','CSS','JS','PHP','LARAVEL','Vue CLI'];
        
        
        for ($i=0; $i < count($categories); $i++) { 
            $new_cat= new Category();
            $new_cat->name=$categories[$i];
            $new_cat->slug=Str::slug($categories[$i].'-');
            $new_cat->save();
        }
    }
}
