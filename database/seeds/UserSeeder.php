<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'name' => 'store',
            'type' => 'store_manager',
            'username' => 'store',
            'email' => 'store@gmail.com',
            'phone_no' => '76899478489030',
            'password' => bcrypt('store'),
        ]);

        User::firstOrCreate([
            'name' => 'kitchen',
            'type' => 'kitchen_manager',
            'username' => 'kitchen',
            'email' => 'kitchen@gmail.com',
            'phone_no' => '76899478489031',
            'password' => bcrypt('kitchen'),
        ]);

        User::firstOrCreate([
            'name' => 'bakery',
            'type' => 'bakery_manager',
            'username' => 'bakery',
            'email' => 'bakery@gmail.com',
            'phone_no' => '76899478489032',
            'password' => bcrypt('bakery'),
        ]);
    }
}
