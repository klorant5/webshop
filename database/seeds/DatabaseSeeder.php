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
        
        \Illuminate\Database\Eloquent\Model::unguard();

//        \App\Product::truncate();
         $this->call(ProductsTableSeeder::class);
    }
}
