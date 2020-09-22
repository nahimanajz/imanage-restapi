<?php

use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create()->each( function($user){

            $credits = factory(App\Credit::class, 3)->make();
            $expenses = factory(App\Expense::class, 4)->make();
            $debits = factory(App\Debit::class ,23)->make();

            $user->credits()->saveMany($credits);
            $user->debits()->saveMany($debits);
            $user->expenses()->saveMany($expenses);
        });
    }
}
