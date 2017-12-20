<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Delivery\Models\User::class)->create([
            'name' => 'Guest',
            'email' => 'guest@domain.com',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10)
        ])->client()->save(factory(\Delivery\Models\Client::class)->make());

        factory(\Delivery\Models\User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@domain.com',
            'password' => bcrypt('secret'),
            'role' => 'admin',
            'remember_token' => str_random(10)
        ])->client()->save(factory(\Delivery\Models\Client::class)->make());

        factory(\Delivery\Models\User::class,3)->create([
            'role' => 'deliveryman'
        ]);

        factory(\Delivery\Models\User::class,10)->create()->each(function($user){
            $user->client()->save(factory(\Delivery\Models\Client::class)->make());
        });
    }
}
