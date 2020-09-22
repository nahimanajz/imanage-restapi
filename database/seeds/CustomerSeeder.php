<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Customer::class, 30)->create()->each(function($customer){

            factory(App\Post::class, 5)->create(['customer_id'=>$customer->id]);

        });
    }
}
