<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $category =\App\Category::create(['category_name'=>'Chain Owner']);
        $category2 =\App\Category::create(['category_name'=>'Individual']);
    }
}
