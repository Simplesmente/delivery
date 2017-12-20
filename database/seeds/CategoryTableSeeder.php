<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Delivery\Models\Category::class,10)->create()->each(function($category){
            for($i=0;$i <= 5;$i++){
                $category->products()->save(factory(\Delivery\Models\Product::class)->make());
            }
        });
    }
}
